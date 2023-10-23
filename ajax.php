<?php

// Función para que no se ejecute el archivo directamente
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])){
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
}

$login = new LogonAuth();
$xss = new Core\XSS();


// Inicio de sesion
if (isset($_POST['usuario'])){
	 $login ->LoginUser($_POST['usuario'], $_POST['password']);
}

if (isset($_POST['opentable'])){
    // primero hacemos un hash
    $hashmesa = sha1($_POST['opentable'].date('d-m-Y h:i:s').$_SESSION['usrNameSession'].randomString(5));
    OpenTable($hashmesa, $_POST['opentable']);
    echo $hashmesa;
}

if (isset($_POST['savetable'])){
    $tableid = $_POST['savetable'];
    $string = $_POST['string'];
    saveStringTable($tableid, $string);
}

if (isset($_POST['mesapagosingle'])){
	
	$pc = $_POST['pc'];
    $mesa = $_POST['mesapagosingle'];
    
    closeMesa($mesa, $pc);

}

if (isset($_POST['config'])){
    
    $titlesite = $xss->XSString($_POST['titlesite']);
    $descsite = $xss->XSString($_POST['descsite']);
    $direccion = $xss->XSString($_POST['direccion']);
    $telefono = $xss->XSString($_POST['telefono']);
    $mesas = $xss->XSString($_POST['mesas']);
    $cateco = $xss->XSString($_POST['cateco']);

    if (empty($titlesite) || ctype_space($titlesite) || is_null($titlesite) || empty($descsite) || ctype_space($descsite) || is_null($descsite) || empty($direccion) || ctype_space($direccion) || is_null($direccion)|| empty($telefono) || ctype_space($telefono) || is_null($telefono) || empty($mesas) || ctype_space($mesas) || is_null($mesas) || empty($cateco) || ctype_space($cateco) || is_null($cateco)){
      echo 1;
      return;
    }

    saveConfig($titlesite,$descsite,$direccion,$telefono,$mesas, $cateco);

}


if (isset($_FILES['fileImageSelectNew'])){
    $image = $_FILES['fileImageSelectNew'];
    ChangeImageSite($image);
}

if (isset($_POST['nombreNewUser'])){

    $nombre = $xss->XSString($_POST['nombreNewUser']);
    $usuario = $xss->XSString($_POST['usuarioNewUser']);
    $password = $xss->XSString($_POST['passwordNewUser']);
    $rank = $xss->XSString($_POST['rank']);
    $status = $xss->XSString($_POST['status']);

    if (empty($nombre) || ctype_space($nombre) || is_null($nombre) || empty($usuario) || ctype_space($usuario) || is_null($usuario) || empty($password) || ctype_space($password) || is_null($password) || empty($rank) || ctype_space($rank) || is_null($rank) || empty($status) || ctype_space($status) || is_null($status)){
      echo 1;
      return;
    }

    createNewUser($nombre,$usuario,$password,$rank,$status);

}

if (isset($_POST['UserTypeEdit'])){
    $usuario = $xss->XSString($_POST['UserTypeEdit']);
    editUserFunction($usuario);
}


if (isset($_POST['DelUserTypeEdit'])){
    $usuario = $xss->XSString($_POST['DelUserTypeEdit']);
    DelUserFunction($usuario);
}

if (isset($_POST['DelInsuTypeEdit'])){
    $DelInsuTypeEdit = $xss->XSString($_POST['DelInsuTypeEdit']);
    DelInsuFunction($DelInsuTypeEdit);
}

if (isset($_POST['idEditUser'])){

    $idEditUser = $xss->XSString($_POST['idEditUser']);
    $nombre = $xss->XSString($_POST['nombreNewUserEditData']);
    $usuario = $xss->XSString($_POST['usuarioNewUserEditData']);
    $password = $xss->XSString($_POST['passwordNewUserEditData']);
    $rank = $xss->XSString($_POST['rankEditData']);
    $status = $xss->XSString($_POST['statusEditData']);

    if (empty($idEditUser) || ctype_space($idEditUser) || is_null($idEditUser) || empty($nombre) || ctype_space($nombre) || is_null($nombre) || empty($usuario) || ctype_space($usuario) || is_null($usuario) || empty($rank) || ctype_space($rank) || is_null($rank) || empty($status) || ctype_space($status) || is_null($status)){
      echo 1;
      return;
    }

    if (empty($password)){
        $fpass = null;
    }else{
        $fpass = $password;
    }

    SaveChangesUser($idEditUser, $nombre,$usuario,$fpass,$rank,$status);

}

if (isset($_POST['nombreCateNew'])){
    
    $nameCateNew = $xss->XSString($_POST['nombreCateNew']);
    if (empty($nameCateNew) || ctype_space($nameCateNew) || is_null($nameCateNew)) {
        echo 1;
        return;
    }

    createNewCate($nameCateNew);

}

if (isset($_POST['UserCateEdit'])){
    $cateEditID = $xss->XSString($_POST['UserCateEdit']);
    if (empty($cateEditID) || ctype_space($cateEditID) || is_null($cateEditID)) {
        echo 1;
        return;
    }
    editCateFunction($cateEditID);
}

if (isset($_POST['InsuEditData'])){
    $InsuEditData = $xss->XSString($_POST['InsuEditData']);
    if (empty($InsuEditData) || ctype_space($InsuEditData) || is_null($InsuEditData)) {
        echo 1;
        return;
    }
    editInsuFunction($InsuEditData);
}


if (isset($_POST['idCateData'])){
    $cateEditID = $xss->XSString($_POST['idCateData']);
    $nombreCateNewEdit = $xss->XSString($_POST['nombreCateNewEdit']);
    if (empty($cateEditID) || ctype_space($cateEditID) || is_null($cateEditID) || empty($nombreCateNewEdit) || ctype_space($nombreCateNewEdit) || is_null($nombreCateNewEdit)) {
        echo 1;
        return;
    }
    saveChangesCate($cateEditID, $nombreCateNewEdit);
}


if (isset($_POST['DelCateTypeEdit'])){
    $cate = $xss->XSString($_POST['DelCateTypeEdit']);
    DelCateFunction($cate);
}

if (isset($_POST['nombreNewIns'])) {

    $nombreNewIns = $xss->XSString($_POST['nombreNewIns']);
    $descripcionNewIns = $xss->XSString($_POST['descripcionNewIns']);
    $categoriaNewIns = $xss->XSString($_POST['categoriaNewIns']);
    $codigoNewIns = $xss->XSString($_POST['codigoNewIns']);
    $precioNewIns = $xss->XSString($_POST['precioNewIns']);

    if (empty($nombreNewIns) || ctype_space($nombreNewIns) || is_null($nombreNewIns) || empty($descripcionNewIns) || ctype_space($descripcionNewIns) || is_null($descripcionNewIns) || empty($categoriaNewIns) || ctype_space($categoriaNewIns) || is_null($categoriaNewIns) || empty($codigoNewIns) || ctype_space($codigoNewIns) || is_null($codigoNewIns) || empty($precioNewIns) || ctype_space($precioNewIns) || is_null($precioNewIns)){
      echo 1;
      return;
    }

    createNewInsumo($nombreNewIns,$descripcionNewIns,$categoriaNewIns,$codigoNewIns,$precioNewIns);

}


if (isset($_POST['idInsuEditData'])) {

    $idInsuData = $xss->XSString($_POST['idInsuEditData']);
    $nombreNewIns = $xss->XSString($_POST['nombreNewInsEdit']);
    $descripcionNewIns = $xss->XSString($_POST['descripcionNewInsEdit']);
    $categoriaNewIns = $xss->XSString($_POST['categoriaNewInsEdit']);
    $codigoNewIns = $xss->XSString($_POST['codigoNewInsEdit']);
    $precioNewIns = $xss->XSString($_POST['precioNewInsEdit']);

    if (empty($idInsuData) || ctype_space($idInsuData) || is_null($idInsuData) || empty($nombreNewIns) || ctype_space($nombreNewIns) || is_null($nombreNewIns) || empty($descripcionNewIns) || ctype_space($descripcionNewIns) || is_null($descripcionNewIns) || empty($categoriaNewIns) || ctype_space($categoriaNewIns) || is_null($categoriaNewIns) || empty($codigoNewIns) || ctype_space($codigoNewIns) || is_null($codigoNewIns) || empty($precioNewIns) || ctype_space($precioNewIns) || is_null($precioNewIns)){
      echo 1;
      return;
    }

    saveChangeInsumo($idInsuData, $nombreNewIns, $descripcionNewIns, $categoriaNewIns, $codigoNewIns, $precioNewIns);

}


if (isset($_POST['folioPrint'])){
    if (is_numeric($_POST['folioPrint'])){
        getLinkPrintFolio($_POST['folioPrint']);
    }else{
        echo 2;
    }
}

if (isset($_POST['nameMesaPerInfo'])){
    createInfoPerMesa($_POST['nameMesaPerInfo']);
}


if (isset($_POST['menaprinfo'])){
    createInfoPerMesero($_POST['menaprinfo']);
}

if (isset($_POST['fechaPerInfoData'])){
    createInfoPerFecha($_POST['fechaPerInfoData']);
}


if (isset($_POST['AllInfoDownload'])){
    createInfoAllDownload();
}

if (isset($_POST['AllInfoDownloadPerDay'])){
    createInfoAllDownloadPerDay();
}
