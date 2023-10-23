<?php

function loginModulo(){
  $dataSite = getDataSite();
  $exp = explode('|', $dataSite);
echo'
<div class="row justify-content-md-center" style="margin-top:10%;">
   <div class="col-md-auto col-lg-3">
      <form id="formLogin">
        <img class="indx-logo" src="'.URLSITE.$exp[2].'">
        <input type="text" class="form-control text-center" name="usuario" placeholder="Usuario">
        <p></p>
        <input type="password" class="form-control text-center" name="password" placeholder="Contraseña">
      </form>
      <p></p>
      <div class="d-grid gap-2">
        <button type="button" class="btn btn-danger loginuser">Iniciar Sesi&oacute;n</button>
      </div>
      <div id="loader-login" class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      <a id="smallcre" href="https://pilaresdelcodigo.wordpress.com/" target="_blank"><small>Hecho por Jesus Herrera - Pilares del Codigo</small></a>
   </div>

</div>
';
}

function mesasModulo(){

  $dataSite = getDataSite();
  $exp = explode('|', $dataSite);

  for ($i=0; $i < $exp[3]; $i++){ 
    $num = $i + 1;

  $SQL = 'SELECT * FROM mesas WHERE numesa = '.$num.' AND fechahora = "'.date('Y-m-d').'" AND status = 1';
  $rst = executor($SQL, 1);
  if (empty($rst)){
    
  echo '
  <div class="col-md-3 text-center">
  <div class="card">
    <div class="card-header">
      <h4>Mesa #'.$num.'</h4>
    </div>
    <div class="card-body">
      <div class="d-grid gap-2">
        <a href="#" onclick="openTable('.$num.');" class="btn btn-success">Abrir Mesa</a>
      </div>
    </div>
  </div>
  <p></p>
  </div>
  ';

  }else{
    foreach ($rst as $key){
        
  echo '
  <div class="col-md-3 text-center">
  <div class="card">
    <div class="card-header">
      <h4>Mesa #'.$num.'</h4>
    </div>
    <div class="card-body">
      <div class="d-grid gap-2">
        <a href="'.URLSITE.'mesa/'.$key['hash'].'" class="btn btn-warning vieworders" data-id="'.$key['id'].'">Ver Ordenes</a>
      </div>
    </div>
  </div>
  <p></p>
  </div>
  ';

    }
  }

  }
  echo '<div id="loaderMesa"><div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';
}

function MenuModulo(){
 
 echo'
   <div id="menu" class="col-md-12 text-center">
      <br>
      <a href="'.URLSITE.'" class="btn btn-outline-secondary"><i class="fa-thin fa-house"></i> Inicio</a>
      <a href="'.URLSITE.'insumos" class="btn btn-outline-secondary"><i class="fa-thin fa-burger-soda"></i> Insumos</a>
      <a href="'.URLSITE.'ordenes" class="btn btn-outline-secondary"><i class="fa-thin fa-file-pen"></i> Ordenes</a>
      <a href="'.URLSITE.'categorias" class="btn btn-outline-secondary"><i class="fa-thin fa-calendar-lines"></i> Categorias</a>
      <a href="'.URLSITE.'usuarios" class="btn btn-outline-info"><i class="fa-thin fa-users-gear"></i> Usuarios</a>
      <a href="'.URLSITE.'informes" class="btn btn-outline-success"><i class="fa-thin fa-file-chart-pie"></i> Informes</a>
      <a href="'.URLSITE.'config" class="btn btn-outline-warning"><i class="fa-thin fa-gear"></i> Configuraci&oacute;n</a>
      <a href="'.URLSITE.'salir" class="btn btn-outline-danger"><i class="fa-thin fa-power-off"></i> Cerrar Sesi&oacute;n</a>
   </div>
 ';

}


// Configuracion
function CubesModulo(){

echo'
<div class="col-md-3 text-center">
   <div class="card">
     <div class="card-body">
        <h3>Ventas del dia</h3>
        <h1>0</h1>
     </div>
   </div>
</div>

<div class="col-md-3 text-center">
   <div class="card">
     <div class="card-body">
        <h3>Mesas Ocupadas</h3>
        <h1>0</h1>
     </div>
   </div>
</div>

<div class="col-md-3 text-center">
   <div class="card">
     <div class="card-body">
        <h3>Usuarios</h3>
        <h1>0</h1>
     </div>
   </div>
</div>

<div class="col-md-3 text-center">
   <div class="card">
     <div class="card-body">
        <h3>Insmos Vendidos</h3>
        <h1>0</h1>
     </div>
   </div>
</div>
';



}

// Modulo de configuracion
function ConfigModulo(){

  $dataSite = getDataSite();
  $exp = explode('|', $dataSite);


echo'
<div class="col-md-12">
   <h1>Configuraci&oacute;n</h1>
</div>
<p></p>
<div class="col-md-6">
<div class="card">
  <div class="card-body">
     <h4>Datos Generales</h4>
     <p></p>
     <form id="formConfigMod">
        <input type="hidden" name="config" value="1">
        <label>Titulo / Nombre</label>
        <input type="text" class="form-control" name="titlesite" value="'.$exp[0].'">
        <p></p>
        <label>Descripcion</label>
        <input type="text" class="form-control" name="descsite" value="'.$exp[1].'">
        <p></p>
        <label>Direcci&oacute;n</label>
        <input type="text" class="form-control" name="direccion" value="'.$exp[4].'">
        <p></p>
        <label>Telefono</label>
        <input type="text" class="form-control" name="telefono" value="'.$exp[5].'">
        <p></p>
        <label>Cantidad de Mesas</label>
        <input type="text" class="form-control" name="mesas" value="'.$exp[3].'">
        <p></p>
        <label>Categoria de Cocina</label>
        <select name="cateco" class="form-control">
        '.getCatePerID($exp[6]).'
        '.getListCate($exp[6]).'
        </select>

     </form>
     <p></p>
     <button class="btn btn-sm btn-outline-success" onclick="saveConfigData();">Guardar Cambios</button>

  </div>
</div>
</div>
<div class="col-md-6">
<div class="card">
  <div class="card-body">
  <h4>Imagen del sistema / Logo</h4>
  <p><img width="150" src="'.URLSITE.$exp[2].'"></p>
  <div class="alert alert-warning text-center" role="alert">
    El logotipo debe de ser un formato PNG con dimensiones especificas (512px / 512px) esto para no afectar el diseño del sistema.
  </div>
  <p></p>
    <form id="imageFormSite">
      <input id="imagePersoSite" type="file" name="fileImageSelectNew" accept="image/png">
    </form>
    <button class="btn btn-block btn-outline-primary chnIMGSite">Cambiar el Logo del sistema</button>


  </div>
</div>
</div>
';

}


function InsumosModulo(){
   echo'
     <div class="col-md-6">
        <h1>Insumos</h1>
     </div>
     <div class="col-md-6">
        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#staticBackdropNewInsumo"><i class="fa-thin fa-rectangle-history-circle-plus"></i> Registrar Nuevo Insumo</button>
     </div>
     <p></p>
     <div class="col-md-12">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Descripci&oacute;n</th>
              <th scope="col">Categoria</th>
              <th scope="col">Codigo</th>
              <th scope="col">Precio</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>';
         
          $SQL = 'SELECT insumos.id, insumos.nombre, insumos.descripcion, insumos.codigo, insumos.precio, categorias.nombre AS catename FROM insumos INNER JOIN categorias ON categorias.id = insumos.categoria';
          $rst = executor($SQL, 1);
          foreach ($rst as $key){
             echo'
            <tr>
              <td>'.$key['nombre'].'</td>
              <td>'.$key['descripcion'].'</td>
              <td>'.$key['catename'].'</td>
              <td>'.$key['codigo'].'</td>
              <td>$'.$key['precio'].'</td>
              <td>
                 <div class="btn-group" role="group" aria-label="Basic example">
                   <button type="button" class="btn btn-sm btn-primary" onclick="editInsu('.$key['id'].');"><i class="fa-thin fa-pen-to-square"></i> Editar</button>
                   <button type="button" class="btn btn-sm btn-danger delinsu" data-bs-toggle="modal" data-bs-target="#staticBackdropInsuDel" data-insu="'.$key['id'].'"><i class="fa-thin fa-trash-can"></i> Eliminar</button>
                 </div>
              </td>
            </tr>
             ';
          }

      echo'</tbody>
        </table>
     </div>
   
<!-- Modal -->
<div class="modal fade" id="staticBackdropNewInsumo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar Nuevo Insumo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="frmNewIns">
           <label>Nombre</label>
           <input type="text" class="form-control" name="nombreNewIns">
           <p></p>
           <label>Descripcion</label>
           <input type="text" class="form-control" name="descripcionNewIns">
           <p></p>
           <label>Categoria</label>
           <select class="form-control" name="categoriaNewIns">
           '.getListCateReturn().'
           </select>
           <p></p>
           <label>Codigo</label>
           <input type="text" class="form-control" name="codigoNewIns">
           <p></p>
           <label>Precio</label>
           <input type="text" class="form-control" name="precioNewIns">
           <p></p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="createNewIn();">Guardar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdropInsuDel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Insumo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          EL insumo tal cual no sera eliminado, esto para no afectar los registros en los informes, pero ya no aparecera en el sistema, esta accion no se puede deshacer.
        </div>
      </div>
      <div class="modal-footer">
        <button id="FinisBtnDelInsu" type="button" class="btn btn-danger">Eliminar Insumo</button>
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>';
}


function categoriasModulo(){
   echo'
     <div class="col-md-6">
        <h1>Categorias</h1>
     </div>
     <div class="col-md-6">
        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-thin fa-rectangle-history-circle-plus"></i> Registrar Nueva Categorias</button>
     </div>
     <p></p>
     <div class="col-md-12">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>';
         
          $SQL = 'SELECT * FROM categorias';
          $rst = executor($SQL, 1);
          foreach ($rst as $key){
             echo'
            <tr>
              <td>'.$key['nombre'].'</td>
              <td>
                 <div class="btn-group" role="group" aria-label="Basic example">
                   <button type="button" class="btn btn-sm btn-primary" onclick="editCate('.$key['id'].');"><i class="fa-thin fa-pen-to-square"></i> Editar</button>
                   <button type="button" class="btn btn-sm btn-danger delcate"  data-bs-toggle="modal" data-bs-target="#staticBackdropDeleteCate" data-cate="'.$key['id'].'"><i class="fa-thin fa-trash-can"></i> Eliminar</button>
                 </div>
              </td>
            </tr>
             ';
          }

      echo'</tbody>
        </table>
     </div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Nueva Categoria</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="cateFormNew">
           <label>Nombre</label>
           <input type="text" class="form-control" name="nombreCateNew">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="CreateNewCate();">Crear Nueva Categoria</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdropDeleteCate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Categoria</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
            Si eliminas la categoria puede afectar a los datos guardados en el sistema, esta accion no se puede deshacer.
         </div>
      </div>
      <div class="modal-footer">
        <button id="FinisBtnDelCate" type="button" class="btn btn-danger">Eliminar Categoria</button>
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
';
}

function usuariosModulo(){
   echo'
     <div class="col-md-6">
        <h1>Usuarios</h1>
     </div>
     <div class="col-md-6">
        <button data-bs-toggle="modal" data-bs-target="#staticNewUser" class="btn btn-sm btn-primary float-end"><i class="fa-thin fa-rectangle-history-circle-plus"></i> Registrar Nuevo Usuario</button>
     </div>
     <p></p>
     <div class="col-md-12">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Usuario</th>
              <th scope="col">Rango</th>
              <th scope="col">Status</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>';
         
          $SQL = 'SELECT * FROM usuarios';
          $rst = executor($SQL, 1);
          foreach ($rst as $key){
             
             if ($key['rank'] == 1){
                $rank = 'Usuario';
             }else{
                $rank = 'Administrador';
             }

             if ($key['status'] == 1){
                $status = 'Inactivo';
             }else{
                $status = 'Activo';
             }


             echo'
            <tr>
              <td>'.$key['nombre'].'</td>
              <td>'.$key['usuario'].'</td>
              <td>'.$rank.'</td>
              <td>'.$status.'</td>
              <td>
                 <div class="btn-group" role="group" aria-label="Basic example">
                   <button type="button" class="btn btn-sm btn-primary" onclick="editarUsuario('.$key['id'].');"><i class="fa-thin fa-pen-to-square"></i> Editar</button>
                   <button type="button" class="btn btn-sm btn-danger deluser" data-user="'.$key['id'].'"  data-bs-toggle="modal" data-bs-target="#staticBackDeleUser"><i class="fa-thin fa-trash-can"></i> Eliminar</button>
                 </div>
              </td>
            </tr>
             ';
          }

      echo'</tbody>
        </table>
     </div>


<!-- Modal -->
<div class="modal fade" id="staticNewUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form id="newUserForm">
             <label>Nombre</label>
             <input type="text" name="nombreNewUser" class="form-control">
             <p></p>
             <label>Usuario</label>
             <input type="text" name="usuarioNewUser" class="form-control">
             <p></p>
             <label>Contraseña</label>
             <input type="text" name="passwordNewUser" class="form-control">
             <p></p>
             <label>Rango</label>
             <select class="form-control" name="rank">
                <option value="1">Usuario</option>
                <option value="2">Administrador</option>
             </select>
             <p></p>
             <label>Estado</label>
             <select class="form-control" name="status">
                <option value="2">Activo</option>
                <option value="1">Inactivo</option>
             </select>
             <p></p>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="createNewuser();">Crear Nuevo Usuario</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackDeleUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Elminar Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="alert alert-danger" role="alert">
            Si eliminas al usuario afectara a los registros del sistema, se recomienda dejar el usuario como inactivo, si de lo contrario deseas continuar se advierte que esta acci&oacute;n no se puede deshacer.
         </div>
      </div>
      <div class="modal-footer">
        <button id="FinisBtnDelUser" type="button" class="btn btn-danger" onclick="DelFinishUser();">Eliminar Usuario</button>
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>';
}

function AddInsumosModulo($idmesa){
   
   $html = '';
   $html .='
     <div class="col-md-12">
        <table class="table" id="myTable2">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Descripci&oacute;n</th>
              <th scope="col">Categoria</th>
              <th scope="col">Codigo</th>
              <th scope="col">Precio</th>
              <th scope="col">&nbsp;</th>
            </tr>
          </thead>
          <tbody>';
         
          $SQL = 'SELECT insumos.id, insumos.nombre, insumos.descripcion, insumos.codigo, insumos.precio, categorias.nombre AS catename FROM insumos INNER JOIN categorias ON categorias.id = insumos.categoria';
          $rst = executor($SQL, 1);
          foreach ($rst as $key){
             $html .='
            <tr id="insumoData'.$key['id'].'">
              <td id="insumoName'.$key['id'].'">'.$key['nombre'].'</td>
              <td>'.$key['descripcion'].'</td>
              <td>'.$key['catename'].'</td>
              <td>'.$key['codigo'].'</td>
              <td id="insumoPriceData'.$key['id'].'" data-price="'.$key['precio'].'">$'.$key['precio'].'</td>
              <td>
                <button onclick="AddInsumoSingle('.$key['id'].','.$idmesa.');" type="button" class="btn btn-outline-warning"><i class="fa-thin fa-cart-plus"></i> Agregar Insumo</button>
              </td>
            </tr>
             ';
          }

      $html .='</tbody>
        </table>
     </div>
   ';

   return $html;
}


function moduloMesaSingle($accion){

   $SQL = 'SELECT * FROM mesas WHERE hash = "'.$accion.'" AND fechahora = "'.date('Y-m-d').'" AND status = 1 AND encargado = '.$_SESSION['idSession'].'';
   $rst = executor($SQL, 1);

   foreach ($rst as $key){

     echo'
        <div class="col-md-12">
           <h1>Mesa #'.$key['numesa'].'</h1>
           <input id="mesaprime" type="text" value="'.$key['id'].'">
        </div>
        <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                 <table class="table table-striped-columns">
                    <thead>
                        <tr>
                          <th>Insumo</th>
                          <th>Precio</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                          <th>Nota</th>
                          <th>Entregado</th>
                        </tr>
                    </thead>
                    <tbody id="insListTbody">'.getListActiveMesa($key['id']).'
                    </tbody>
                 </table>
              </div>
            </div>  
            <p></p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#InsumosAdd">Agregar Insumos</button>
            <a href="'.URLSITE.'" class="btn btn-warning">Volver</a>      
        </div>
        <div class="col-md-3">
            <div class="card">
              <div class="card-body text-center">
                <h3>Total:</h3>
                <h1 class="totalsumh">$'.TOTALSUM.'</h1>
              </div>
            </div>    
            <p></p>
            <button class="btn btn-block btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#modalCobro" onclick="coip();">Cobrar</button>    
        </div>

<!-- Modal -->
<div class="modal fade" id="InsumosAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Insumos</h1>
      </div>
      <div class="modal-body">
        '.AddInsumosModulo($key['id']).'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalCobro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <label>Pago con:</label>
        <input id="paymo" type="text" class="form-control text-center" placeholder="$0">
        <div style="display:none;" class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-primary" onclick="Cobrar();">Cobrar</button>
        <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

     ';

   }

}


function ListOrdenesPerCate(){

   $SQL = 'SELECT * FROM mesas WHERE status = 1';
   $rst = executor($SQL, 1);
   $tr = '';
   foreach ($rst as $key){

    $articulos = $key['articulos'];
    $mesa = $key['numesa'];
    $mesero = $key['encargado'];

    // Tomamos el string
    $fsData = explode(',', $key['articulos']);

    // Contamos la cantidad que esta separada
    $fsDCount = count($fsData);

    // Sacamos todo lo necesario
    $insInfoStr = '';
    $sumTotal = null;
    for ($i=0; $i < $fsDCount; $i++) { 
        $insInfoStr .= getRowsInfoOrders($fsData[$i], $mesero, $mesa);
    }
    $tr .= '<tr>'.$insInfoStr.'</tr>';
   }

   echo'
     <table class="table">
        <thead>
           <tr>
              <th>Insumo</th>
              <th>Cantidad</th>
              <th>Detalles</th>
              <th>Mesero</th>
              <th>Mesa</th>
           </tr>
        </thead>
        <tbody>
           '.$tr.'
        </tbody>
     </table>


   ';

}


function informesModulo(){

     $dataSite = getDataSite();
     $exp = explode('|', $dataSite);
     $mesas = $exp[3];
     $enuso = countTablesUs();
     $resta = $mesas - $enuso;

     // Ganancias del dia
     $money = countVentasMoney();
     $arti = getCountInsumoVentas();

echo'
  <div class="col-md-3">
   <div class="card">
     <div class="card-body text-center">
       <h5>Mesas Ocupadas</h5>
       <h2>'.$enuso.'</h2>
     </div>
   </div>
  </div>
  <div class="col-md-3">
   <div class="card">
     <div class="card-body text-center">
       <h5>Mesas Libres</h5>
       <h2>'.$resta.'</h2>
     </div>
   </div>
  </div>
  <div class="col-md-3">
   <div class="card">
     <div class="card-body text-center">
       <h5>Insumos Vendidos del Dia</h5>
       <h2>'.$arti.'</h2>
     </div>
   </div>
  </div>
  <div class="col-md-3">
   <div class="card">
     <div class="card-body text-center">
       <h5>Ganancias del Dia</h5>
       <h2>$'.$money.'</h2>
     </div>
   </div>
  </div>

<p></p>
<div class="col-md-3">
<div class="card">
  <div id="infobtns" class="card-body text-center">
     <h3>Descarga de Informes</h3><p></p>
     <button  data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-btn="1" type="button" class="btn btn-block btn-primary">Descargar Informe Completo de Ventas</button>
     <button  data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-btn="2" type="button" class="btn btn-block btn-secondary">Descargar Informe Completo de Ventas por Mesero</button>
     <button  data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-btn="3" type="button" class="btn btn-block btn-success">Descargar Informe Completo de Ventas Por Fecha</button>
     <button  data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-btn="4" type="button" class="btn btn-block btn-danger">Descargar Informe Completo de Ventas Por Mesa</button>
     <button  data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-btn="5" type="button" class="btn btn-block btn-warning">Descargar Informe Completo de Ventas del Dia</button>
     <button  data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-btn="6" type="button" class="btn btn-block btn-light">Imprimir Ticket por Folio</button>
  </div>
</div>
</div>
<div class="col-md-9">

<div class="card">
  <div class="card-body">

  </div>
</div>
<p></p>
<div class="card">
  <div class="card-body">
    <h3>Ventas del Dia</h3>
    <p></p>
    <table id="myTable" class="table">
       <thead>
          <tr>
            <th scope="col">Folio</th>
            <th scope="col">Mesa</th>
            <th scope="col">Mesero</th>
            <th scope="col">Detalles</th>
            <th scope="col">Hora</th>
            <th scope="col">Ganancia</th>
            <th scope="col">Ticket</th>
          </tr>
       </thead>
       <tbody>
         '.salesToday().'
       </tbody>
    </table>




  </div>
</div>
</div>


<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Informes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
 
           <form id="printperTicket">
             <label>Folio</label>
             <input name="folioPrint" type="text" class="form-control text-center">
             <p></p>
             <button type="button" onclick="printTicketPerTicket();" class="btn btn-primary">Imprimir Ticket</button>
           </form>

           <form id="mesaPrintForm">
             <label>Mesa</label>
             <select class="form-control text-center" name="nameMesaPerInfo">
             ';
              $dataSite = getDataSite();
              $exp = explode('|', $dataSite);
              for ($i=0; $i < $exp[3]; $i++) { 
                $num = $i + 1;
                echo '<option value="'.$num.'">Mesa #'.$num.'</option>';
              }

             echo'
             </select>
             <p></p>
             <button type="button" onclick="printTicketPerMesa();" class="btn btn-primary">Obtener Informe</button>
           </form>

           <form id="fomInfoPerUser">
             <label>Mesero</label>
             <select name="menaprinfo" class="form-control">
                 '.getMeserosRtn().'
             </select>
             <p></p>
             <button type="button" onclick="printInfoPerMesero();" class="btn btn-primary">Obtener Informe</button>
           </form>


           <form class="row" id="ForminfoPerDate">
             <label for="date" class="col-1 col-form-label">Fecha</label>
               <div class="input-group date" id="datepicker">
                 <input name="fechaPerInfoData" type="text" class="form-control text-center" id="date"/>
                 <span class="input-group-append">
                   <span class="input-group-text bg-light d-block">
                    <i class="fa-thin fa-calendar-days"></i>
                   </span>
                 </span>
             </div>

           <p></p>
           <div class="col-md-12">
            <button type="button" onclick="printInfoPerFecha();" class="btn btn-primary">Obtener Informe</button>
           </div>

           </form>



      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


';
}