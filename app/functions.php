<?php

// Ejecutar sentencias
function executor($SQL, $mode){
     $conexion = DataBase::conexion();
     $stn = $conexion -> prepare($SQL);
     $stn -> execute();  
     if (!empty($mode) || !is_null($mode)){
       $rst = $stn -> fetchAll();
       return $rst;
     }
     $conexion = null;
}


function randomString($length=15){
    $char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $clen = strlen($char);
    $rand = "";
    for ($i=0; $i<$length; $i++) { $rand .= $char[rand(0, $clen-1)]; }
    return $rand;
}

// Datos del Sitio
function getDataSite(){
    $SQL = 'SELECT * FROM configuration WHERE id = 1';
    $rst = executor($SQL, 1);
    foreach ($rst as $key){
      $data = $key['titlesite'].'|'.$key['descsite'].'|'.$key['logo'].'|'.$key['mesas'].'|'.$key['direccion'].'|'.$key['telefono'].'|'.$key['cateco'];
    }
    return $data;
}

function isAdmin(){
    $SQL = 'SELECT * FROM usuarios WHERE id = '.$_SESSION['idSession'].' AND rank = 2 LIMIT 1';
    $rst = executor($SQL, 1);
    if (empty($rst)){
      return false;
    }else{
      return true;
    }
}

// Titulo del sitio
function normalTitleSite(){
  $dataSite = getDataSite();
  $exp = explode('|', $dataSite);
  $title = $exp[0].' - '.$exp[1];
  return $title;
}

function siteTitleWithString($entry){
  $dataSite = getDataSite();
  $exp = explode('|', $dataSite);
  $title = ucfirst($entry).' - '.$exp[1];
  define('CANONICAL', URLSITE.$entry);
    return $title; 
}

function isLogin(){
    $router = new LogonAuth();
    $check = $router->login_check();
    return $check;
}

function getListActiveMesa($id){

    $SQL = 'SELECT * FROM mesas WHERE id = '.$id.' LIMIT 1';
    $rst = executor($SQL, 1);
    foreach ($rst as $key){
      $data = $key['articulos'];
    }

    $final = getInfoInsumosMesa($data);

    return $final;

}

function getListCate($id){
    $SQL = 'SELECT * FROM categorias WHERE id <> '.$id.'';
    $rst = executor($SQL, 1);
    $cates = '';
    foreach ($rst as $key){
      $cates .= '<option value="'.$key['id'].'">'.$key['nombre'].'</option>';
    }
    return $cates;
}

function getListCateReturn(){
    $SQL = 'SELECT * FROM categorias';
    $rst = executor($SQL, 1);
    $cates = '';
    foreach ($rst as $key){
      $cates .= '<option value="'.$key['id'].'">'.$key['nombre'].'</option>';
    }
    return $cates;
}

function getCatePerID($id){

    $SQL = 'SELECT * FROM categorias WHERE id= '.$id.'';
    $rst = executor($SQL, 1);
    $cates = '';
    foreach ($rst as $key){
      $cates .= '<option value="'.$key['id'].'">'.$key['nombre'].'</option>';
    }
    return $cates;

}


function getInfoInsumosMesa($string){
    // Tomamos el string
    $fsData = explode(',', $string);

    // Contamos la cantidad que esta separada
    $fsDCount = count($fsData);

    // Sacamos todo lo necesario
    $insInfoStr = '';
    $sumTotal = null;
    for ($i=0; $i < $fsDCount; $i++) { 
       $insInfoStr .= getRowsInfo($fsData[$i]);
       $sumTotal += getTotalInfoRow($fsData[$i]);
    }

    define('TOTALSUM', $sumTotal);
    return $insInfoStr;
}

function getTotalInfoRow($string){

     $insData = explode('|', $string);

     $SQL = 'SELECT * FROM insumos WHERE id = '.$insData[0].'';
     $rst = executor($SQL, 1);
     $suma = '';
     foreach ($rst as $key){
         
       $suma = $key['precio'] * $insData[1];

     }

     return $suma;

}

function getRowsInfo($string){

     $insData = explode('|', $string);

     $SQL = 'SELECT * FROM insumos WHERE id = '.$insData[0].'';
     $rst = executor($SQL, 1);
     $dt = '';
     foreach ($rst as $key){
        
        $subtotal = $key['precio'] * $insData[1];
        if ($insData[2] == 1){
          $check = '<a class="recpt" data-status="false"><h4><i class="fa-thin fa-circle-xmark" style="color: #ef3636;"></i></h4></a>';
        }else{
          $check = '<a class="recpt" data-status="true" disabled><h4><i class="fa-thin fa-circle-check" style="color: #c8ef36;"></i></h4></a>';
        }

        $dt = '
        <tr id="trinsumesa'.$insData[0].'" class="trinsumolista"><td>'.$key['nombre'].'</td>
             <td id="priceIns'.$insData[0].'" data-price="'.$key['precio'].'">$'.$key['precio'].'</td>
             <td>
               <div class="input-group mb-3">
                 <button onclick="minuIns('.$insData[0].');" class="btn btn-sm btn-outline-danger"><i class="fa-thin fa-minus"></i></button><input id="cantInsInpt'.$insData[0].'" type="text" class="form-control text-center" value="'.$insData[1].'" disabled><button onclick="MaxIns('.$insData[0].');" class="btn btn-sm btn-outline-success"><i class="fa-thin fa-plus"></i></button>
               </div>
             </td>
             <td class="text-center subtotalpro" id="subTl'.$insData[0].'" data-subtl="'.$subtotal.'">$'.$subtotal.'</td>
             <td>
               <div class="input-group mb-3">
                 <input id="dtlins'.$insData[0].'" type="text" class="form-control" value="'.base64_decode($insData[3]).'">
                 <button onclick="getStringData();" class="btn btn-sm btn-outline-info" type="button" id="button-addon2">
                    <i class="fa-thin fa-floppy-disk-pen"></i>
                 </button>
               </div>
             </td>
             <td class="text-center">'.$check.'</td></tr>';
     }

     return $dt;

}


// Crear Mesa Vacia
function OpenTable($hash, $mesa){
   $SQL = 'INSERT INTO mesas (id, numesa, fechahora, articulos, encargado, hash, status) VALUES (NULL, '.$mesa.', "'.date('Y-m-d').'", "", '.$_SESSION['idSession'].', "'.$hash.'", 1); ';
   executor($SQL, 0);
}


function saveStringTable($tableid, $string){
   executor('UPDATE mesas SET articulos = "'.str_replace(' ', '', $string).'" WHERE id = '.$tableid.'', 0);
}

function closeMesa($mesa, $pc){
   $SQL = 'SELECT * FROM mesas WHERE id = '.$mesa.'';
   $rst = executor($SQL, 1);
   foreach ($rst as $key){
       $idmesa = $key['id'];
       $mesa = $key['numesa'];
       $articulos  = $key['articulos'];
       $encargado  = $key['encargado'];
       $hash  = $key['hash'];
       getInfoInsumosMesa($articulos);
   }

   $rest = $pc - TOTALSUM; 
   $vnt = 'INSERT INTO ventas (id, idmesa, mesa, usuario, articulos, ano, mes, dia, hora, total, pagocon, cambio, hash) VALUES (NULL, '.$idmesa.', '.$mesa.', '.$_SESSION['idSession'].', "'.$articulos.'", "'.date('Y').'", "'.date('m').'", "'.date('d').'", "'.date('h:i a').'", "'.TOTALSUM.'", "'.$pc.'", "'.$rest.'", "'.$hash.'");';
   executor($vnt, 0);
   executor('UPDATE mesas SET status = "2" WHERE id = '.$idmesa.';', 0);
   echo $hash;

}


function getRowsInfoSuccess($string){

     $insData = explode('|', $string);

     $SQL = 'SELECT * FROM insumos WHERE id = '.$insData[0].'';
     $rst = executor($SQL, 1);
     $dt = '';
     foreach ($rst as $key){
        
        $dt = '
        <tr>
        <td>'.$key['nombre'].'</td>
        <td>$'.$key['precio'].'</td>
        <td>'.$insData[1].'</td>
        <td>'.base64_decode($insData[3]).'</td>
        </tr>';
     }

     return $dt;

}


function displayVentaData($accion){
   
   $SQL = 'SELECT * FROM ventas WHERE hash = "'.$accion.'" LIMIT 1';
   $rst = executor($SQL, 1);
   foreach ($rst as $key){

    // Tomamos el string
    $fsData = explode(',', $key['articulos']);

    // Contamos la cantidad que esta separada
    $fsDCount = count($fsData);

    // Sacamos todo lo necesario
    $insInfoStr = '';
    $sumTotal = null;
   for ($i=0; $i < $fsDCount; $i++) { 
       $insInfoStr .= getRowsInfoSuccess($fsData[$i]);
   }

   echo'
      <div class="col-md-12">
       <div class="alert alert-success text-center" role="alert">
          <h4>Venta registrada exitosamente</h4>
       </div>
      </div> 

      <div class="col-md-12">

        <div class="card">
          <div class="card-body text-center">
            <table class="table">
              <thead>
                  <tr>
                     <th>Insumo</th>
                     <th>Precio</th>
                     <th>Cantidad</th>
                     <th>Detalles en la Orden</th>
                  </tr>
              </thead>
              <tbody>
                '.$insInfoStr.'
              </tbody>
            </table>
          </div>
        </div>

      </div>
      <div class="col-md-3">
        <p></p>
        <div class="card">
          <div class="card-body text-center">
              <h3>Total: <p>$'.$key['total'].'</p></h3>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <p></p>
        <div class="card">
          <div class="card-body text-center">
              <h3>Pago con: <p>$'.$key['pagocon'].'</p></h3>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <p></p>
        <div class="card">
          <div class="card-body text-center">
              <h3>Cambio: <p>$'.$key['cambio'].'</p></h3>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <p></p>
        <a href="'.URLSITE.'" style="margin-bottom:4%;" class="btn btn-block btn-outline-warning"><i class="fa-thin fa-ticket"></i> Volver al Inicio</a>
        
        <a target="_blank" href="'.URLSITE.'ticket/'.$key['hash'].'" class="btn btn-block btn-outline-primary"><i class="fa-thin fa-ticket"></i> Imprimir Ticket</a>
        

      </div>
   ';

   }


}



function getRowsInfoTicket($string){

     $insData = explode('|', $string);

     $SQL = 'SELECT * FROM insumos WHERE id = '.$insData[0].'';
     $rst = executor($SQL, 1);
     $dt = '';
     foreach ($rst as $key){
        
        $ttlper = $key['precio'] * $insData[1];
        $dt = '
        '.$key['nombre'].' [$'.$key['precio'].']  ['.$insData[1].'] ......... $'.$ttlper.'<p></p>
        ';
     }
     return $dt;
}

function nameMesero($id){

     $SQL = 'SELECT * FROM usuarios WHERE id = '.$id.'';
     $rst = executor($SQL, 1);
     foreach ($rst as $key){
        $mesero = $key['nombre'];
     }
     return $mesero;
}

function showTicket($accion){

   $dataSite = getDataSite();
   $exp = explode('|', $dataSite);
   $title = $exp[0].' - '.$exp[1];

   $SQL = 'SELECT * FROM ventas WHERE hash = "'.$accion.'"';
   $rst = executor($SQL, 1);
   foreach ($rst as $key){

    // Tomamos el string
    $fsData = explode(',', $key['articulos']);

    // Contamos la cantidad que esta separada
    $fsDCount = count($fsData);

    // Sacamos todo lo necesario
    $insInfoStr = '';
    $sumTotal = null;
    for ($i=0; $i < $fsDCount; $i++) { 
        $insInfoStr .= getRowsInfoTicket($fsData[$i]);
    }

echo'
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <style>
    *{margin: 5px;}
    body{text-align: center;}
  </style>
</head>
<body>
  <img width="100" src="'.URLSITE.$exp[2].'">
  <h2><strong>'.$exp[0].'</strong></h2>
  <p>'.$exp[4].'</p>
  <p>'.$exp[5].'</p>
  <p>Fecha: '.$key['dia'].'/'.$key['mes'].'/'.$key['ano'].' - '.$key['hora'].'</p>
  <hr>
  '.$insInfoStr.'
  <hr>
  Le atendio: '.nameMesero($key['usuario']).'
  <hr>
  <h3><strong>TOTAL: $'.$key['total'].'</strong></h3>
  <p>Pago: $'.$key['pagocon'].' - Cambio: $'.$key['cambio'].'</p>
  <p>Folio: '.$key['id'].'</p>
  <script>
     document.addEventListener("DOMContentLoaded", function(event) {
        window.print();
     }); 
  </script>
</body>
</html>
';
  }
}

function saveConfig($titlesite, $descsite, $direccion, $telefono, $mesas, $cateco){

     $SQL = 'UPDATE configuration SET titlesite = "'.$titlesite.'", descsite = "'.$descsite.'", mesas = '.$mesas.', direccion = "'.$direccion.'", telefono = "'.$telefono.'", cateco = "'.$cateco.'" WHERE id = 1;';
     executor($SQL, 0);
     echo $SQL;

}


function ChangeImageSite($fil){

    if (!isAdmin() == true){return;}
    $datasite = getDataSite();
    $ex = explode('|', $datasite);
    $tipo = $fil["type"];
    $nombre = $fil['name'];
    $ext = pathinfo($fil['name'], PATHINFO_EXTENSION);
    $dirUp = __DIR__.'/images/';
    $rnd = randomString(25);
    $finalname = 'images/'.$rnd.'.'.$ext;

    if ($tipo == "image/png"){

       $final = move_uploaded_file($fil["tmp_name"], $finalname);        
       if ($ex[2] == 'images/default.png'){

            $SQL = 'UPDATE configuration SET logo = "'.$finalname.'" WHERE id = 1';
            executor($SQL ,0);

       }else{

            $SQL = 'SELECT logo FROM configuration WHERE id = 1 LIMIT 1';
            $rst = executor($SQL ,1);
            foreach ($rst as $key){
                $prev = $key['logo'];
            }

            unlink($prev);
            $SQLu = 'UPDATE configuration SET logo = "'.$finalname.'" WHERE id = 1';
            executor($SQLu ,0);

       }

    }else{
      echo 2;
    }

}


function createNewUser($nombre,$usuario,$password,$rank,$status){
     $rst = executor('SELECT * FROM usuarios WHERE usuario = "'.$usuario.'";', 1);
     if (empty($rst)){
       $ResCrypt = sha1($password.SALT);
       $SQL = 'INSERT INTO usuarios (id, nombre, usuario, password, rank, status) VALUES (NULL, "'.$nombre.'", "'.$usuario.'", "'.$ResCrypt.'", '.$rank.', '.$status.');';
       executor($SQL, 0);
     }else{
       echo 2;
       return;
     }
}

function editUserFunction($usuario){
   $SQL = 'SELECT * FROM usuarios WHERE id = '.$usuario.'';
   $rst = executor($SQL, 1);
   foreach ($rst as $key){
   
   $rnk = '';
   $sts = '';

   if ($key['rank'] == 1){
     $rnk = '
        <option value="1">Usuario</option>
        <option value="2">Administrador</option>
     ';
   }else{
     $rnk = '
        <option value="2">Administrador</option>
        <option value="1">Usuario</option>
     ';
   }

   if ($key['status'] == 2){
     $stsusr = '
        <option value="2">Activo</option>
        <option value="1">Inactivo</option>
     ';
   }else{
     $stsusr = '
        <option value="1">Inactivo</option>
        <option value="2">Activo</option>
     ';
   } 

   echo'
<!-- Modal -->
<div class="modal fade" id="staticEditUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form id="newUserFormEdit">
             <input type="hidden" name="idEditUser" value="'.$key['id'].'">
             <label>Nombre</label>
             <input type="text" name="nombreNewUserEditData" class="form-control" value="'.$key['nombre'].'">
             <p></p>
             <label>Usuario</label>
             <input type="text" name="usuarioNewUserEditData" class="form-control" value="'.$key['usuario'].'">
             <p></p>
             <label>Contraseña</label>
             <input type="text" name="passwordNewUserEditData" class="form-control">
             <p></p>
             <label>Rango</label>
             <select class="form-control" name="rankEditData">
                '.$rnk.'
             </select>
             <p></p>
             <label>Estado</label>
             <select class="form-control" name="statusEditData">
                '.$stsusr.'
             </select>
             <p></p>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="SaveChangesUser();">Guardar Cambios</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
   ';
   }
}

function DelUserFunction($usuario){
  $SQL = 'DELETE FROM usuarios WHERE id = '.$usuario.'';
  executor($SQL, 0);
}

function DelInsuFunction($insu){
  $SQL = 'UPDATE insumos SET status = 2 WHERE id ='.$insu.'';
  executor($SQL, 0);
}


function SaveChangesUser($idEditUser,$nombre,$usuario,$fpass,$rank,$status){

     $rst = executor('SELECT * FROM usuarios WHERE usuario = "'.$usuario.'";', 1);
     if (empty($rst)){
       
       if (is_null($fpass)) {
         $SQL = 'UPDATE usuarios SET nombre = "'.$nombre.'", usuario = "'.$usuario.'", rank = '.$rank.', status = '.$status.' WHERE id = '.$idEditUser.'';
       }else{
         $ResCrypt = sha1($password.SALT);
         $SQL = 'UPDATE usuarios SET nombre = "'.$nombre.'", usuario = "'.$usuario.'", password = "'.$ResCrypt.'", rank = '.$rank.', status = '.$status.' WHERE id = '.$idEditUser.'';
       }

       executor($SQL, 0);
     }else{
       echo 2;
       return;
     }
}


function createNewCate($nameCateNew){
    $SQL = 'INSERT INTO categorias (id, nombre) VALUES (NULL, "'.$nameCateNew.'");';
    executor($SQL, 0);
}

function editCateFunction($categoria){
   $SQL = 'SELECT * FROM categorias WHERE id = '.$categoria.'';
   $rst = executor($SQL, 1);
   foreach ($rst as $key){
   echo'
<!-- Modal -->
<div class="modal fade" id="staticBackdropEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Nueva Categoria</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="cateFormNewEdit">
           <input type="hidden" name="idCateData" value="'.$key['id'].'"> 
           <label>Nombre</label>
           <input type="text" class="form-control" name="nombreCateNewEdit" value="'.$key['nombre'].'">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="SaveChangesCate();">Guardar Cambios</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
   ';
   }
}


function saveChangesCate($cateEditID, $nombreCateNewEdit){
   $SQL = 'UPDATE categorias SET nombre = "'.$nombreCateNewEdit.'" WHERE id = '.$cateEditID.'';
   $rst = executor($SQL, 0);
}

function DelCateFunction($cate){
  $SQL = 'DELETE FROM categorias WHERE id = '.$cate.'';
  executor($SQL, 0);
}

function createNewInsumo($nombreNewIns,$descripcionNewIns,$categoriaNewIns,$codigoNewIns,$precioNewIns){

  $SQL = 'INSERT INTO insumos (codigo, nombre, descripcion, precio, categoria, state) VALUES ("'.$codigoNewIns.'", "'.$nombreNewIns.'", "'.$descripcionNewIns.'", "'.$precioNewIns.'", "'.$categoriaNewIns.'", 1);';
  executor($SQL, 0);

}


function editInsuFunction($insu){
   $SQL = 'SELECT * FROM insumos WHERE id = '.$insu.'';
   $rst = executor($SQL, 1);
   foreach ($rst as $key){
   echo'
<!-- Modal -->
<div class="modal fade" id="staticBackdropEditInsu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar Nuevo Insumo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="frmNewInsEditSave">
           <input type="hidden" name="idInsuEditData" value="'.$key['id'].'">
           <label>Nombre</label>
           <input type="text" class="form-control" name="nombreNewInsEdit" value="'.$key['nombre'].'">
           <p></p>
           <label>Descripcion</label>
           <input type="text" class="form-control" name="descripcionNewInsEdit" value="'.$key['descripcion'].'">
           <p></p>
           <label>Categoria</label>
           <select class="form-control" name="categoriaNewInsEdit">
               '.getCatePerID($key['categoria']).'
               '.getListCate($key['categoria']).'
           </select>
           <p></p>
           <label>Codigo</label>
           <input type="text" class="form-control" name="codigoNewInsEdit" value="'.$key['codigo'].'">
           <p></p>
           <label>Precio</label>
           <input type="text" class="form-control" name="precioNewInsEdit" value="'.$key['precio'].'">
           <p></p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="saveInsuChangeData();">Guardar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
   ';
   }
}


function saveChangeInsumo($idInsuData,$nombreNewIns,$descripcionNewIns,$categoriaNewIns,$codigoNewIns,$precioNewIns){

  $SQL = 'UPDATE insumos SET codigo = "'.$codigoNewIns.'", nombre = "'.$nombreNewIns.'", descripcion = "'.$descripcionNewIns.'", precio = "'.$precioNewIns.'", categoria = '.$categoriaNewIns.', state = 1 WHERE id = '.$idInsuData.'';
   $rst = executor($SQL, 0);

}


function getRowsInfoOrders($string, $mesero, $mesa){

     $insData = explode('|', $string);
     $dataSite = getDataSite();
     $exp = explode('|', $dataSite);

     $SQL = 'SELECT * FROM insumos WHERE id = '.$insData[0].' AND categoria = '.$exp[6].'';
     $rst = executor($SQL, 1);
     $dt = '';
     foreach ($rst as $key){

       if ($insData[2] == 1) {
         $dt .= '<td>'.$key['nombre'].'</td><td>'.$insData[1].'</td><td>'.base64_decode($insData[3]).'</td><td>'.nameMesero($mesero).'</td><td>'.$mesa.'</td>';
       }

     }
     return $dt;
}


function countTablesUs(){
    
    $SQL = 'SELECT COUNT(*) AS cuantos FROM mesas WHERE status = 1 AND fechahora = "'.date('Y-m-d').'"';
    $rst = executor($SQL, 1);
    foreach ($rst as $key){
      return $key['cuantos'];
    }

}


function countVentasMoney(){
    
    $SQL = 'SELECT * FROM ventas WHERE ano = "'.date('Y').'" AND mes  = "'.date('m').'" AND dia  = "'.date('d').'"';
    $rst = executor($SQL, 1);
    $money = '';
    foreach ($rst as $key){
      $money += $key['total'];
    }

    return $money;

}

function someart($art){

    $vrt = explode(',', $art);
    $cnt = count($vrt);
    $rest = $cnt - 1;
    return $rest;

}

function getCountInsumoVentas(){

    $SQL = 'SELECT * FROM ventas WHERE ano = "'.date('Y').'" AND mes  = "'.date('m').'" AND dia  = "'.date('d').'"';
    $rst = executor($SQL, 1);
    $counter = '';
    foreach ($rst as $key){
       $counter += someart($key['articulos']);
    }

    return $counter;

}

function getRowsInfoInfo($string){
     $insData = explode('|', $string);
     $SQL = 'SELECT * FROM insumos WHERE id = '.$insData[0].'';
     $rst = executor($SQL, 1);
     $dt = '';
     foreach ($rst as $key){ 
        $dt = '<p style="padding:0px;margin:0px;">'.$key['nombre'].' - ['.$insData[1].'] [$'.$key['precio'].']</p>';
     }
     return $dt;
}

function getRowsInfoInfoFlat($string){
     $insData = explode('|', $string);
     $SQL = 'SELECT * FROM insumos WHERE id = '.$insData[0].'';
     $rst = executor($SQL, 1);
     $dt = '';
     foreach ($rst as $key){ 
        $dt = ''.$key['nombre'].' - ['.$insData[1].'] [$'.$key['precio'].'] | ';
     }
     return $dt;
}


function salesToday(){

    $SQL = 'SELECT * FROM ventas WHERE ano = "'.date('Y').'" AND mes  = "'.date('m').'" AND dia  = "'.date('d').'"';
    $rst = executor($SQL, 1);
    $html = '';


    foreach ($rst as $key){

       // Tomamos el string
       $fsData = explode(',', $key['articulos']);

       // Contamos la cantidad que esta separada
       $fsDCount = count($fsData);

       // Sacamos todo lo necesario
       $insInfoStr = '';
       $sumTotal = null;
       for ($i=0; $i < $fsDCount; $i++) { 
           $insInfoStr .= getRowsInfoInfo($fsData[$i]);
       }

       $html .='
          <tr>
            <td>'.$key['id'].'</td>
            <td>'.$key['mesa'].'</td>
            <td>'.nameMesero($key['usuario']).'</td>
            <td>'.$insInfoStr.'</td>
            <td>'.$key['hora'].'</td>
            <td>$'.$key['total'].'</td>
            <td><a href="'.URLSITE.'ticket/'.$key['hash'].'" target="_blank">Imprimir Ticket</a></td>
          </tr>
       ';
    }

    return $html;

}

function getLinkPrintFolio($ticket){
 
    $SQL = 'SELECT * FROM ventas WHERE id = '.$ticket.'';
    $rst = executor($SQL, 1);
    if (empty($rst)) {
      echo 2;
    }else{
      foreach ($rst as $key){
        echo URLSITE.'ticket/'.$key['hash'];
      }      
    }

}


function createInfoPerMesa($mesa){
    
    $pdir = dirname(__FILE__);
    $pfal = str_replace('app', '', $pdir);
    define('TMPXLS', $pfal.'\assets\empty');
    $xlsx = new eiseXLSX($pfal."\assets\mynewfile.xlsx");

    $SQL = 'SELECT * FROM ventas WHERE mesa = '.$mesa.'';
    $rst = executor($SQL, 1);

    $numi = 3;
    foreach ($rst as $key){

       $numi = $numi + 1;
       // Tomamos el string
       $fsData = explode(',', $key['articulos']);

       // Contamos la cantidad que esta separada
       $fsDCount = count($fsData);

       // Sacamos todo lo necesario
       $insInfoStr = '';
       $sumTotal = null;
       for ($i=0; $i < $fsDCount; $i++) { 
           $insInfoStr .= getRowsInfoInfoFlat($fsData[$i]);
       }

       $xlsx->data('A'.$numi, $key['id']);
       $xlsx->data('B'.$numi, $key['mesa']);
       $xlsx->data('C'.$numi, nameMesero($key['usuario']));
       $xlsx->data('D'.$numi, $insInfoStr);
       $xlsx->data('E'.$numi, $key['dia'].'/'.$key['mes'].'/'.$key['ano'].' - '.date('H:i a', strtotime($key['hora'])));
       $xlsx->data('F'.$numi, '$'.$key['total']);

    }
    $numi++;

    $namefile = $mesa.' - '.date('d-m-Y').' - '.rand(3214,9999).'.xlsx';
    $xlsx->Output($pfal.'xls\Informe Mesa '.$namefile, "F"); // save the file

    echo URLSITE.'xls/Informe Mesa '.$namefile;

}


function getMeserosRtn(){

    $SQL = 'SELECT * FROM usuarios WHERE rank = 1 AND status = 2';
    $rst = executor($SQL, 1);
    if (empty($rst)) {
      echo 2;
    }else{
      $msdt = '';
      foreach ($rst as $key){
        $msdt .= '<option value="'.$key['id'].'">'.$key['nombre'].'</option>';
      }      
      return $msdt;
    }

}



function createInfoPerMesero($mesero){
    
    $pdir = dirname(__FILE__);
    $pfal = str_replace('app', '', $pdir);
    define('TMPXLS', $pfal.'\assets\empty');
    $xlsx = new eiseXLSX($pfal."\assets\mynewfile.xlsx");

    $SQL = 'SELECT * FROM ventas WHERE usuario = '.$mesero.'';
    $rst = executor($SQL, 1);

    $numi = 3;
    foreach ($rst as $key){

       $numi = $numi + 1;
       // Tomamos el string
       $fsData = explode(',', $key['articulos']);

       // Contamos la cantidad que esta separada
       $fsDCount = count($fsData);

       // Sacamos todo lo necesario
       $insInfoStr = '';
       $sumTotal = null;
       for ($i=0; $i < $fsDCount; $i++) { 
           $insInfoStr .= getRowsInfoInfoFlat($fsData[$i]);
       }

       $xlsx->data('A'.$numi, $key['id']);
       $xlsx->data('B'.$numi, $key['mesa']);
       $xlsx->data('C'.$numi, nameMesero($key['usuario']));
       $xlsx->data('D'.$numi, $insInfoStr);
       $xlsx->data('E'.$numi, $key['dia'].'/'.$key['mes'].'/'.$key['ano'].' - '.date('H:i a', strtotime($key['hora'])));
       $xlsx->data('F'.$numi, '$'.$key['total']);

    }
    $numi++;

    $namefile = $mesa.' - '.date('d-m-Y').' - '.rand(3214,9999).'.xlsx';
    $xlsx->Output($pfal.'xls\Informe Por Mesero '.$namefile, "F"); // save the file

    echo URLSITE.'xls/Informe Por Mesero '.$namefile;

}


function createInfoPerFecha($fecha){

    $exp = explode('/', $fecha);

    $dia = $exp[0];
    $mes = $exp[1];
    $year = $exp[2];

    $pdir = dirname(__FILE__);
    $pfal = str_replace('app', '', $pdir);
    define('TMPXLS', $pfal.'\assets\empty');
    $xlsx = new eiseXLSX($pfal."\assets\mynewfile.xlsx");

    $SQL = 'SELECT * FROM `ventas` WHERE `ano` = '.$year.' AND `mes` = '.$dia.' AND `dia` = '.$mes.'';
    $rst = executor($SQL, 1);

    $numi = 3;
    foreach ($rst as $key){

       $numi = $numi + 1;
       // Tomamos el string
       $fsData = explode(',', $key['articulos']);

       // Contamos la cantidad que esta separada
       $fsDCount = count($fsData);

       // Sacamos todo lo necesario
       $insInfoStr = '';
       $sumTotal = null;
       for ($i=0; $i < $fsDCount; $i++) { 
           $insInfoStr .= getRowsInfoInfoFlat($fsData[$i]);
       }

       $xlsx->data('A'.$numi, $key['id']);
       $xlsx->data('B'.$numi, $key['mesa']);
       $xlsx->data('C'.$numi, nameMesero($key['usuario']));
       $xlsx->data('D'.$numi, $insInfoStr);
       $xlsx->data('E'.$numi, $key['dia'].'/'.$key['mes'].'/'.$key['ano'].' - '.date('H:i a', strtotime($key['hora'])));
       $xlsx->data('F'.$numi, '$'.$key['total']);

    }
    $numi++;

    $namefile = $mesa.' - '.date('d-m-Y').' - '.rand(3214,9999).'.xlsx';
    $xlsx->Output($pfal.'xls\Informe Por Fecha '.$namefile, "F"); // save the file

    echo URLSITE.'xls/Informe Por Fecha '.$namefile;

}



function createInfoAllDownload(){

    $pdir = dirname(__FILE__);
    $pfal = str_replace('app', '', $pdir);
    define('TMPXLS', $pfal.'\assets\empty');
    $xlsx = new eiseXLSX($pfal."\assets\mynewfile.xlsx");

    $SQL = 'SELECT * FROM `ventas`';
    $rst = executor($SQL, 1);

    $numi = 3;
    foreach ($rst as $key){

       $numi = $numi + 1;
       // Tomamos el string
       $fsData = explode(',', $key['articulos']);

       // Contamos la cantidad que esta separada
       $fsDCount = count($fsData);

       // Sacamos todo lo necesario
       $insInfoStr = '';
       $sumTotal = null;
       for ($i=0; $i < $fsDCount; $i++) { 
           $insInfoStr .= getRowsInfoInfoFlat($fsData[$i]);
       }

       $xlsx->data('A'.$numi, $key['id']);
       $xlsx->data('B'.$numi, $key['mesa']);
       $xlsx->data('C'.$numi, nameMesero($key['usuario']));
       $xlsx->data('D'.$numi, $insInfoStr);
       $xlsx->data('E'.$numi, $key['dia'].'/'.$key['mes'].'/'.$key['ano'].' - '.date('H:i a', strtotime($key['hora'])));
       $xlsx->data('F'.$numi, '$'.$key['total']);

    }
    $numi++;

    $namefile = $mesa.' - '.date('d-m-Y').' - '.rand(3214,9999).'.xlsx';
    $xlsx->Output($pfal.'xls\Informe Total '.$namefile, "F"); // save the file

    echo URLSITE.'xls/Informe Total '.$namefile;

}


function createInfoAllDownloadPerDay(){

    $pdir = dirname(__FILE__);
    $pfal = str_replace('app', '', $pdir);
    define('TMPXLS', $pfal.'\assets\empty');
    $xlsx = new eiseXLSX($pfal."\assets\mynewfile.xlsx");

    $SQL = 'SELECT * FROM `ventas` WHERE ano = '.date('Y').' AND mes = '.date('m').' AND dia='.date('d').' ';
    $rst = executor($SQL, 1);

    $numi = 3;
    foreach ($rst as $key){

       $numi = $numi + 1;
       // Tomamos el string
       $fsData = explode(',', $key['articulos']);

       // Contamos la cantidad que esta separada
       $fsDCount = count($fsData);

       // Sacamos todo lo necesario
       $insInfoStr = '';
       $sumTotal = null;
       for ($i=0; $i < $fsDCount; $i++) { 
           $insInfoStr .= getRowsInfoInfoFlat($fsData[$i]);
       }

       $xlsx->data('A'.$numi, $key['id']);
       $xlsx->data('B'.$numi, $key['mesa']);
       $xlsx->data('C'.$numi, nameMesero($key['usuario']));
       $xlsx->data('D'.$numi, $insInfoStr);
       $xlsx->data('E'.$numi, $key['dia'].'/'.$key['mes'].'/'.$key['ano'].' - '.date('H:i a', strtotime($key['hora'])));
       $xlsx->data('F'.$numi, '$'.$key['total']);

    }
    $numi++;

    $namefile = $mesa.' - '.date('d-m-Y').' - '.rand(3214,9999).'.xlsx';
    $xlsx->Output($pfal.'xls\Informe Total del Dia '.$namefile, "F"); // save the file

    echo URLSITE.'xls/Informe Total del Dia '.$namefile;

}