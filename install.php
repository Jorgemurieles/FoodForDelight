<?php
if (isset($_POST['testConection'])){try{$dbh = new pdo("mysql:host=".$_POST["hostingData"].";dbname=".$_POST["DataBaseData"]."",$_POST["usuarioData"],$_POST["contraData"],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));echo "1";die();}catch(PDOException $ex){echo "2";die();}$dbh = null;}if (isset($_POST['finalConect'])){try{$pdo = new pdo("mysql:host=".$_POST["hostingData"].";dbname=".$_POST["DataBaseData"]."",$_POST["usuarioData"],$_POST["contraData"],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}catch(PDOException $ex){}$SQL = 'Q1JFQVRFIFRBQkxFIGBjYXRlZ29yaWFzYCAoCiAgYGlkYCBpbnQoMTEpIE5PVCBOVUxMLAogIGBub21icmVgIHZhcmNoYXIoMjUwKSBOT1QgTlVMTAopIEVOR0lORT1Jbm5vREIgREVGQVVMVCBDSEFSU0VUPXV0Zjg7CkNSRUFURSBUQUJMRSBgY29uZmlndXJhdGlvbmAgKAogIGBpZGAgaW50KDExKSBOT1QgTlVMTCwKICBgdGl0bGVzaXRlYCB2YXJjaGFyKDI1MCkgTk9UIE5VTEwsCiAgYGRlc2NzaXRlYCB2YXJjaGFyKDI1MCkgTk9UIE5VTEwsCiAgYGxvZ29gIHZhcmNoYXIoMjUwKSBOT1QgTlVMTCwKICBgbWVzYXNgIGludCgxMSkgTk9UIE5VTEwsCiAgYGRpcmVjY2lvbmAgdmFyY2hhcigyNTApIE5PVCBOVUxMLAogIGB0ZWxlZm9ub2AgdmFyY2hhcigyNTApIE5PVCBOVUxMLAogIGBjYXRlY29gIGludCgxMSkgTk9UIE5VTEwKKSBFTkdJTkU9SW5ub0RCIERFRkFVTFQgQ0hBUlNFVD11dGY4OwpJTlNFUlQgSU5UTyBgY29uZmlndXJhdGlvbmAgKGBpZGAsIGB0aXRsZXNpdGVgLCBgZGVzY3NpdGVgLCBgbG9nb2AsIGBtZXNhc2AsIGBkaXJlY2Npb25gLCBgdGVsZWZvbm9gLCBgY2F0ZWNvYCkgVkFMVUVTCigxLCAnSkhSZXN0YXVyYW50JywgJ1Npc3RlbWEgTGlnZXJvIHBhcmEgUmVzdGF1cmFudGVzJywgJ2ltYWdlcy9kZWZhdWx0LnBuZycsIDgsICdDYWxsZSBTaWVtcHJlIFZpdmEgIzEyMycsICc4NDQxMjM0NTY5JywgMik7CkNSRUFURSBUQUJMRSBgaW5zdW1vc2AgKAogIGBpZGAgYmlnaW50KDIwKSBVTlNJR05FRCBOT1QgTlVMTCwKICBgY29kaWdvYCB2YXJjaGFyKDEwMCkgTk9UIE5VTEwsCiAgYG5vbWJyZWAgdmFyY2hhcigxMDApIE5PVCBOVUxMLAogIGBkZXNjcmlwY2lvbmAgdmFyY2hhcigyNTUpIE5PVCBOVUxMLAogIGBwcmVjaW9gIGRlY2ltYWwoMTUsMikgTk9UIE5VTEwsCiAgYGNhdGVnb3JpYWAgYmlnaW50KDIwKSBVTlNJR05FRCBOT1QgTlVMTCwKICBgc3RhdGVgIGludCgxMSkgTk9UIE5VTEwKKSBFTkdJTkU9SW5ub0RCIERFRkFVTFQgQ0hBUlNFVD11dGY4OwpDUkVBVEUgVEFCTEUgYG1lc2FzYCAoCiAgYGlkYCBiaWdpbnQoMTEpIE5PVCBOVUxMLAogIGBudW1lc2FgIGludCgxMSkgTk9UIE5VTEwsCiAgYGZlY2hhaG9yYWAgZGF0ZSBOT1QgTlVMTCwKICBgYXJ0aWN1bG9zYCBsb25ndGV4dCBOT1QgTlVMTCwKICBgZW5jYXJnYWRvYCBpbnQoMTEpIE5PVCBOVUxMLAogIGBoYXNoYCB2YXJjaGFyKDI1MCkgTk9UIE5VTEwsCiAgYHN0YXR1c2AgaW50KDExKSBOT1QgTlVMTAopIEVOR0lORT1Jbm5vREIgREVGQVVMVCBDSEFSU0VUPXV0Zjg7CkNSRUFURSBUQUJMRSBgdXN1YXJpb3NgICgKICBgaWRgIGludCgxMSkgTk9UIE5VTEwsCiAgYG5vbWJyZWAgdmFyY2hhcigyNTApIE5PVCBOVUxMLAogIGB1c3VhcmlvYCB2YXJjaGFyKDI1KSBOT1QgTlVMTCwKICBgcGFzc3dvcmRgIHZhcmNoYXIoMjUwKSBOT1QgTlVMTCwKICBgcmFua2AgaW50KDExKSBOT1QgTlVMTCwKICBgc3RhdHVzYCBpbnQoMTEpIE5PVCBOVUxMCikgRU5HSU5FPUlubm9EQiBERUZBVUxUIENIQVJTRVQ9dXRmODsKQ1JFQVRFIFRBQkxFIGB2ZW50YXNgICgKICBgaWRgIGJpZ2ludCgxMSkgTk9UIE5VTEwsCiAgYGlkbWVzYWAgaW50KDExKSBOT1QgTlVMTCwKICBgbWVzYWAgaW50KDExKSBOT1QgTlVMTCwKICBgdXN1YXJpb2AgaW50KDExKSBOT1QgTlVMTCwKICBgYXJ0aWN1bG9zYCB0ZXh0IE5PVCBOVUxMLAogIGBhbm9gIHZhcmNoYXIoNCkgTk9UIE5VTEwsCiAgYG1lc2AgdmFyY2hhcigyKSBOT1QgTlVMTCwKICBgZGlhYCB2YXJjaGFyKDIpIE5PVCBOVUxMLAogIGBob3JhYCB2YXJjaGFyKDEwKSBOT1QgTlVMTCwKICBgdG90YWxgIGRlY2ltYWwoMTUsMikgTk9UIE5VTEwsCiAgYHBhZ29jb25gIGRlY2ltYWwoMTUsMikgTk9UIE5VTEwsCiAgYGNhbWJpb2AgZGVjaW1hbCgxNSwyKSBOT1QgTlVMTCwKICBgaGFzaGAgdmFyY2hhcigyNTApIE5PVCBOVUxMCikgRU5HSU5FPUlubm9EQiBERUZBVUxUIENIQVJTRVQ9dXRmODsKQUxURVIgVEFCTEUgYGNhdGVnb3JpYXNgIEFERCBQUklNQVJZIEtFWSAoYGlkYCk7CkFMVEVSIFRBQkxFIGBjb25maWd1cmF0aW9uYCBBREQgUFJJTUFSWSBLRVkgKGBpZGApOwpBTFRFUiBUQUJMRSBgaW5zdW1vc2AgQUREIFBSSU1BUlkgS0VZIChgaWRgKTsKQUxURVIgVEFCTEUgYG1lc2FzYCBBREQgUFJJTUFSWSBLRVkgKGBpZGApOwpBTFRFUiBUQUJMRSBgdXN1YXJpb3NgIEFERCBQUklNQVJZIEtFWSAoYGlkYCk7CkFMVEVSIFRBQkxFIGB2ZW50YXNgIEFERCBQUklNQVJZIEtFWSAoYGlkYCk7CkFMVEVSIFRBQkxFIGBjYXRlZ29yaWFzYCBNT0RJRlkgYGlkYCBpbnQoMTEpIE5PVCBOVUxMIEFVVE9fSU5DUkVNRU5UOwpBTFRFUiBUQUJMRSBgaW5zdW1vc2AgTU9ESUZZIGBpZGAgYmlnaW50KDIwKSBVTlNJR05FRCBOT1QgTlVMTCBBVVRPX0lOQ1JFTUVOVDsKQUxURVIgVEFCTEUgYG1lc2FzYCBNT0RJRlkgYGlkYCBiaWdpbnQoMTEpIE5PVCBOVUxMIEFVVE9fSU5DUkVNRU5UOwpBTFRFUiBUQUJMRSBgdXN1YXJpb3NgIE1PRElGWSBgaWRgIGludCgxMSkgTk9UIE5VTEwgQVVUT19JTkNSRU1FTlQ7CkFMVEVSIFRBQkxFIGB2ZW50YXNgIE1PRElGWSBgaWRgIGJpZ2ludCgxMSkgTk9UIE5VTEwgQVVUT19JTkNSRU1FTlQsIEFVVE9fSU5DUkVNRU5UPTEyMzQ1NjsgQ09NTUlUOw==';$pdo->prepare(base64_decode($SQL))->execute();$crypt = sha1($_POST['passDataU'].$_POST['randomSal']);$pdo->prepare("INSERT INTO usuarios (id, nombre, usuario, password, rank, status) VALUES (NULL, '".$_POST["nameDataU"]."', '".$_POST["userDataU"]."', '".$crypt."', 2, 2);")->execute();$fileIndex = fopen("index.php", "w");fwrite($fileIndex, "<?php".PHP_EOL);fwrite($fileIndex, "error_reporting(0);".PHP_EOL);fwrite($fileIndex, "date_default_timezone_set('".$_POST["zonahoraria"]."');".PHP_EOL);fwrite($fileIndex, "\$hosting = '".$_POST['hostingData']."';".PHP_EOL);fwrite($fileIndex, "\$basededatos = '".$_POST['DataBaseData']."';".PHP_EOL);fwrite($fileIndex, "\$usuariobd = '".$_POST['usuarioData']."';".PHP_EOL);fwrite($fileIndex, "\$passbd = '".$_POST['contraData']."';".PHP_EOL);fwrite($fileIndex, "\$app_folder = 'app';".PHP_EOL);fwrite($fileIndex, "\$assets_folder = 'assets';".PHP_EOL);fwrite($fileIndex, "\$url_site = '".$_POST['urlprogram']."';".PHP_EOL);fwrite($fileIndex, "\$sal = '".$_POST['randomSal']."';".PHP_EOL);fwrite($fileIndex, "define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));".PHP_EOL);fwrite($fileIndex, "define('BASEPATH', \$app_folder);".PHP_EOL);fwrite($fileIndex, "define('ASSETSPATH', \$assets_folder);".PHP_EOL);fwrite($fileIndex, "define('URLSITE', \$url_site);".PHP_EOL);fwrite($fileIndex, "define('HOSTINGDB', \$hosting);".PHP_EOL);fwrite($fileIndex, "define('DATABASENAME', \$basededatos);".PHP_EOL);fwrite($fileIndex, "define('USERDATABASE', \$usuariobd);".PHP_EOL);fwrite($fileIndex, "define('PASSDATABASE', \$passbd);".PHP_EOL);fwrite($fileIndex, "define('HOMEPAGE', 'home');".PHP_EOL);fwrite($fileIndex, "define('SALT', \$sal);".PHP_EOL);fwrite($fileIndex, "require_once BASEPATH.'/autoload.php';".PHP_EOL);fclose($fileIndex);$pdo = null;return;
    }if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){$url = "https://";}else{$url = "http://";}$url.= $_SERVER['HTTP_HOST'];$url.= $_SERVER['REQUEST_URI'];define('URLHOST', str_replace('install.php', '', $url));function generateRandomString($length = 10){$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';$charactersLength = strlen($characters);$randomString = '';for ($i = 0; $i < $length; $i++) {$randomString .= $characters[rand(0, $charactersLength - 1)];}return $randomString;} ?>
<!doctype html>
<html lang="es" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instalador del Sistema</title>
    <link href="style.css" rel="stylesheet">
    <style type="text/css">
      #failconexion{
        display: none;
      }
      #installation{
        text-align: center;
      }
      #finalInstallForm{
        display: none;
      }
      .loader {
      width: 48px;
      height: 48px;
      border: 5px solid #FFF;
      border-bottom-color: #FF3D00;
      border-radius: 50%;
      display: inline-block;
      box-sizing: border-box;
      animation: rotation 1s linear infinite;
      }

    @keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    }  
    </style>

  </head>
  <body>
    <div class="container">
      <div style="margin-top: 3%;" class="row d-flex justify-content-center">
         <div class="col-md-5 ">
            <h2 class="text-center">Instalador del Sistema</h2>
            <p></p>
            <div class="card">
              <div class="card-body">
                  <div id="failconexion" class="alert alert-danger text-center">La conexion a base de datos ha fallado, revisa tus datos de conexion para continuar con la instalación del programa.</div>
                  <div id="installation"></div>
                 <form id="conectionfrm">
                   <h4 class="text-center">Base de Datos</h4>
                   <p></p>
                   <label>Hosting</label>
                   <input type="text" class="form-control" name="hostingData" value="localhost"><p></p>
                   <label>Base de datos</label>
                   <input type="text" class="form-control" name="DataBaseData"><p></p>
                   <label>Usuario:</label>
                   <input type="text" class="form-control" name="usuarioData"><p></p>
                   <label>Contraseña:</label>
                   <input type="text" class="form-control" name="contraData"><p></p>
                   <label>URL:</label>
                   <input class="form-control" type="text" id="urlprogramval" name="urlprogram" value="<?php echo URLHOST; ?>" readonly>
                   <input type="hidden" name="randomSal" value="<?php echo generateRandomString(); ?>"><p></p>
                   <label>Zona Horaria:</label>
                   <select class="form-control" name="zonahoraria">
                     <optgroup label="US (Common)">
                       <option value="America/Puerto_Rico">Puerto Rico (Atlantic)</option>
                       <option value="America/New_York">New York (Eastern)</option>
                       <option value="America/Chicago">Chicago (Central)</option>
                       <option value="America/Denver">Denver (Mountain)</option>
                       <option value="America/Phoenix">Phoenix (MST)</option>
                       <option value="America/Los_Angeles">Los Angeles (Pacific)</option>
                       <option value="America/Anchorage">Anchorage (Alaska)</option>
                       <option value="Pacific/Honolulu">Honolulu (Hawaii)</option>
                     </optgroup>

                     <optgroup label="America">
                       <option value="America/Adak">Adak</option>
                       <option value="America/Anchorage">Anchorage</option>
                       <option value="America/Anguilla">Anguilla</option>
                       <option value="America/Antigua">Antigua</option>
                       <option value="America/Araguaina">Araguaina</option>
                       <option value="America/Argentina/Buenos_Aires">Argentina - Buenos Aires</option>
                       <option value="America/Argentina/Catamarca">Argentina - Catamarca</option>
                       <option value="America/Argentina/ComodRivadavia">Argentina - ComodRivadavia</option>
                       <option value="America/Argentina/Cordoba">Argentina - Cordoba</option>
                       <option value="America/Argentina/Jujuy">Argentina - Jujuy</option>
                       <option value="America/Argentina/La_Rioja">Argentina - La Rioja</option>
                       <option value="America/Argentina/Mendoza">Argentina - Mendoza</option>
                       <option value="America/Argentina/Rio_Gallegos">Argentina - Rio Gallegos</option>
                       <option value="America/Argentina/Salta">Argentina - Salta</option>
                       <option value="America/Argentina/San_Juan">Argentina - San Juan</option>
                       <option value="America/Argentina/San_Luis">Argentina - San Luis</option>
                       <option value="America/Argentina/Tucuman">Argentina - Tucuman</option>
                       <option value="America/Argentina/Ushuaia">Argentina - Ushuaia</option>
                       <option value="America/Aruba">Aruba</option>
                       <option value="America/Asuncion">Asuncion</option>
                       <option value="America/Atikokan">Atikokan</option>
                       <option value="America/Atka">Atka</option>
                       <option value="America/Bahia">Bahia</option>
                       <option value="America/Barbados">Barbados</option>
                       <option value="America/Belem">Belem</option>
                       <option value="America/Belize">Belize</option>
                       <option value="America/Blanc-Sablon">Blanc-Sablon</option>
                       <option value="America/Boa_Vista">Boa Vista</option>
                       <option value="America/Bogota">Bogota</option>
                       <option value="America/Boise">Boise</option>
                       <option value="America/Buenos_Aires">Buenos Aires</option>
                       <option value="America/Cambridge_Bay">Cambridge Bay</option>
                       <option value="America/Campo_Grande">Campo Grande</option>
                       <option value="America/Cancun">Cancun</option>
                       <option value="America/Caracas">Caracas</option>
                       <option value="America/Catamarca">Catamarca</option>
                       <option value="America/Cayenne">Cayenne</option>
                       <option value="America/Cayman">Cayman</option>
                       <option value="America/Chicago">Chicago</option>
                       <option value="America/Chihuahua">Chihuahua</option>
                       <option value="America/Coral_Harbour">Coral Harbour</option>
                       <option value="America/Cordoba">Cordoba</option>
                       <option value="America/Costa_Rica">Costa Rica</option>
                       <option value="America/Cuiaba">Cuiaba</option>
                       <option value="America/Curacao">Curacao</option>
                       <option value="America/Danmarkshavn">Danmarkshavn</option>
                       <option value="America/Dawson">Dawson</option>
                       <option value="America/Dawson_Creek">Dawson Creek</option>
                       <option value="America/Denver">Denver</option>
                       <option value="America/Detroit">Detroit</option>
                       <option value="America/Dominica">Dominica</option>
                       <option value="America/Edmonton">Edmonton</option>
                       <option value="America/Eirunepe">Eirunepe</option>
                       <option value="America/El_Salvador">El Salvador</option>
                       <option value="America/Ensenada">Ensenada</option>
                       <option value="America/Fortaleza">Fortaleza</option>
                       <option value="America/Fort_Wayne">Fort Wayne</option>
                       <option value="America/Glace_Bay">Glace Bay</option>
                       <option value="America/Godthab">Godthab</option>
                       <option value="America/Goose_Bay">Goose Bay</option>
                       <option value="America/Grand_Turk">Grand Turk</option>
                       <option value="America/Grenada">Grenada</option>
                       <option value="America/Guadeloupe">Guadeloupe</option>
                       <option value="America/Guatemala">Guatemala</option>
                       <option value="America/Guayaquil">Guayaquil</option>
                       <option value="America/Guyana">Guyana</option>
                       <option value="America/Halifax">Halifax</option>
                       <option value="America/Havana">Havana</option>
                       <option value="America/Hermosillo">Hermosillo</option>
                       <option value="America/Indiana/Indianapolis">Indiana - Indianapolis</option>
                       <option value="America/Indiana/Knox">Indiana - Knox</option>
                       <option value="America/Indiana/Marengo">Indiana - Marengo</option>
                       <option value="America/Indiana/Petersburg">Indiana - Petersburg</option>
                       <option value="America/Indiana/Tell_City">Indiana - Tell City</option>
                       <option value="America/Indiana/Vevay">Indiana - Vevay</option>
                       <option value="America/Indiana/Vincennes">Indiana - Vincennes</option>
                       <option value="America/Indiana/Winamac">Indiana - Winamac</option>
                       <option value="America/Indianapolis">Indianapolis</option>
                       <option value="America/Inuvik">Inuvik</option>
                       <option value="America/Iqaluit">Iqaluit</option>
                       <option value="America/Jamaica">Jamaica</option>
                       <option value="America/Jujuy">Jujuy</option>
                       <option value="America/Juneau">Juneau</option>
                       <option value="America/Kentucky/Louisville">Kentucky - Louisville</option>
                       <option value="America/Kentucky/Monticello">Kentucky - Monticello</option>
                       <option value="America/Knox_IN">Knox IN</option>
                       <option value="America/La_Paz">La Paz</option>
                       <option value="America/Lima">Lima</option>
                       <option value="America/Los_Angeles">Los Angeles</option>
                       <option value="America/Louisville">Louisville</option>
                       <option value="America/Maceio">Maceio</option>
                       <option value="America/Managua">Managua</option>
                       <option value="America/Manaus">Manaus</option>
                       <option value="America/Marigot">Marigot</option>
                       <option value="America/Martinique">Martinique</option>
                       <option value="America/Matamoros">Matamoros</option>
                       <option value="America/Mazatlan">Mazatlan</option>
                       <option value="America/Mendoza">Mendoza</option>
                       <option value="America/Menominee">Menominee</option>
                       <option value="America/Merida">Merida</option>
                       <option value="America/Mexico_City">Mexico City</option>
                       <option value="America/Miquelon">Miquelon</option>
                       <option value="America/Moncton">Moncton</option>
                       <option value="America/Monterrey">Monterrey</option>
                       <option value="America/Montevideo">Montevideo</option>
                       <option value="America/Montreal">Montreal</option>
                       <option value="America/Montserrat">Montserrat</option>
                       <option value="America/Nassau">Nassau</option>
                       <option value="America/New_York">New York</option>
                       <option value="America/Nipigon">Nipigon</option>
                       <option value="America/Nome">Nome</option>
                       <option value="America/Noronha">Noronha</option>
                       <option value="America/North_Dakota/Center">North Dakota - Center</option>
                       <option value="America/North_Dakota/New_Salem">North Dakota - New Salem</option>
                       <option value="America/Ojinaga">Ojinaga</option>
                       <option value="America/Panama">Panama</option>
                       <option value="America/Pangnirtung">Pangnirtung</option>
                       <option value="America/Paramaribo">Paramaribo</option>
                       <option value="America/Phoenix">Phoenix</option>
                       <option value="America/Port-au-Prince">Port-au-Prince</option>
                       <option value="America/Porto_Acre">Porto Acre</option>
                       <option value="America/Port_of_Spain">Port of Spain</option>
                       <option value="America/Porto_Velho">Porto Velho</option>
                       <option value="America/Puerto_Rico">Puerto Rico</option>
                       <option value="America/Rainy_River">Rainy River</option>
                       <option value="America/Rankin_Inlet">Rankin Inlet</option>
                       <option value="America/Recife">Recife</option>
                       <option value="America/Regina">Regina</option>
                       <option value="America/Resolute">Resolute</option>
                       <option value="America/Rio_Branco">Rio Branco</option>
                       <option value="America/Rosario">Rosario</option>
                       <option value="America/Santa_Isabel">Santa Isabel</option>
                       <option value="America/Santarem">Santarem</option>
                       <option value="America/Santiago">Santiago</option>
                       <option value="America/Santo_Domingo">Santo Domingo</option>
                       <option value="America/Sao_Paulo">Sao Paulo</option>
                       <option value="America/Scoresbysund">Scoresbysund</option>
                       <option value="America/Shiprock">Shiprock</option>
                       <option value="America/St_Barthelemy">St Barthelemy</option>
                       <option value="America/St_Johns">St Johns</option>
                       <option value="America/St_Kitts">St Kitts</option>
                       <option value="America/St_Lucia">St Lucia</option>
                       <option value="America/St_Thomas">St Thomas</option>
                       <option value="America/St_Vincent">St Vincent</option>
                       <option value="America/Swift_Current">Swift Current</option>
                       <option value="America/Tegucigalpa">Tegucigalpa</option>
                       <option value="America/Thule">Thule</option>
                       <option value="America/Thunder_Bay">Thunder Bay</option>
                       <option value="America/Tijuana">Tijuana</option>
                       <option value="America/Toronto">Toronto</option>
                       <option value="America/Tortola">Tortola</option>
                       <option value="America/Vancouver">Vancouver</option>
                       <option value="America/Virgin">Virgin</option>
                       <option value="America/Whitehorse">Whitehorse</option>
                       <option value="America/Winnipeg">Winnipeg</option>
                       <option value="America/Yakutat">Yakutat</option>
                       <option value="America/Yellowknife">Yellowknife</option>
                     </optgroup>
                   </select><p></p>
                   <button type="button" class="btn btn-success checkConnection">Probar Conexion</button>

                 </form>

                 <form id="finalInstallForm">
                    <div id="successConct" class="alert alert-success text-center">La conexion a base de datos fue exitosa, rellena los datos para terminar la instalacion.</div>
                    <p></p>
                    <label>Nombre:</label>
                    <input type="text" name="nameDataU" class="form-control"><p></p>
                    <label>Usuario:</label>
                    <input type="text" name="userDataU" class="form-control"><p></p>
                    <label>Contraseña:</label>
                    <input type="text" name="passDataU" class="form-control"><p></p>
                    <button type="button" class="btn btn-warning installFinalBtn" >Terminar Instalación</button>
                 </form>



              </div>
            </div>           
         </div>
      </div>
    </div>

  <script src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
var _0xe190=["\x63\x6C\x69\x63\x6B","\x73\x65\x72\x69\x61\x6C\x69\x7A\x65","\x23\x63\x6F\x6E\x65\x63\x74\x69\x6F\x6E\x66\x72\x6D","\x50\x4F\x53\x54","\x69\x6E\x73\x74\x61\x6C\x6C\x2E\x70\x68\x70","\x74\x65\x73\x74\x43\x6F\x6E\x65\x63\x74\x69\x6F\x6E\x3D\x31\x26","\x68\x69\x64\x65","\x2E\x63\x68\x65\x63\x6B\x43\x6F\x6E\x6E\x65\x63\x74\x69\x6F\x6E","\x3C\x73\x70\x61\x6E\x20\x63\x6C\x61\x73\x73\x3D\x22\x6C\x6F\x61\x64\x65\x72\x22\x3E\x3C\x2F\x73\x70\x61\x6E\x3E","\x61\x70\x70\x65\x6E\x64","\x23\x69\x6E\x73\x74\x61\x6C\x6C\x61\x74\x69\x6F\x6E","","\x68\x74\x6D\x6C","\x72\x65\x73\x65\x74","\x73\x68\x6F\x77","\x23\x66\x61\x69\x6C\x63\x6F\x6E\x65\x78\x69\x6F\x6E","\x23\x66\x69\x6E\x61\x6C\x49\x6E\x73\x74\x61\x6C\x6C\x46\x6F\x72\x6D","\x61\x6A\x61\x78","\x6F\x6E","\x66\x69\x6E\x61\x6C\x43\x6F\x6E\x65\x63\x74\x3D\x31\x26","\x26","\x23\x73\x75\x63\x63\x65\x73\x73\x43\x6F\x6E\x63\x74","\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x22\x61\x6C\x65\x72\x74\x20\x61\x6C\x65\x72\x74\x2D\x73\x75\x63\x63\x65\x73\x73\x20\x74\x65\x78\x74\x2D\x63\x65\x6E\x74\x65\x72\x22\x3E\x49\x6E\x73\x74\x61\x6C\x61\x63\x69\xF3\x6E\x20\x63\x6F\x6D\x70\x6C\x65\x74\x61\x21\x20\x65\x73\x20\x69\x6D\x70\x6F\x72\x74\x61\x6E\x74\x65\x20\x71\x75\x65\x20\x62\x6F\x72\x72\x65\x73\x20\x65\x6C\x20\x61\x72\x63\x68\x69\x76\x6F\x20\x3C\x73\x74\x72\x6F\x6E\x67\x3E\x69\x6E\x73\x74\x61\x6C\x6C\x2E\x70\x68\x70\x3C\x2F\x73\x74\x72\x6F\x6E\x67\x3E\x20\x64\x65\x20\x74\x75\x20\x73\x65\x72\x76\x69\x64\x6F\x72\x2C\x20\x61\x68\x6F\x72\x61\x20\x73\x65\x72\x61\x73\x20\x72\x65\x64\x69\x72\x65\x63\x63\x69\x6F\x6E\x61\x64\x6F\x20\x65\x6E\x20\x62\x72\x65\x76\x65\x2E\x3C\x2F\x64\x69\x76\x3E\x3C\x62\x72\x3E\x3C\x68\x72\x3E","\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x76\x61\x6C","\x23\x75\x72\x6C\x70\x72\x6F\x67\x72\x61\x6D\x76\x61\x6C","\x2E\x69\x6E\x73\x74\x61\x6C\x6C\x46\x69\x6E\x61\x6C\x42\x74\x6E"];$(_0xe190[7])[_0xe190[18]](_0xe190[0],function(){var _0x1d79x1=$(_0xe190[2])[_0xe190[1]]();$[_0xe190[17]]({type:_0xe190[3],url:_0xe190[4],data:_0xe190[5]+ _0x1d79x1,beforeSend:function(){$(_0xe190[2])[_0xe190[6]]();$(_0xe190[7])[_0xe190[6]]();$(_0xe190[10])[_0xe190[9]](_0xe190[8])},success:function(_0x1d79x2){if(_0x1d79x2== 2){setTimeout(function(){$(_0xe190[10])[_0xe190[12]](_0xe190[11]);$(_0xe190[2])[0][_0xe190[13]]();$(_0xe190[2])[_0xe190[14]]();$(_0xe190[7])[_0xe190[14]]();$(_0xe190[15])[_0xe190[14]]()},2000)}else {setTimeout(function(){$(_0xe190[10])[_0xe190[12]](_0xe190[11]);$(_0xe190[16])[_0xe190[14]]();$(_0xe190[15])[_0xe190[6]]()},2000)}},error:function(){}})});$(_0xe190[27])[_0xe190[18]](_0xe190[0],function(){var _0x1d79x1=$(_0xe190[2])[_0xe190[1]]();var _0x1d79x3=$(_0xe190[16])[_0xe190[1]]();$[_0xe190[17]]({type:_0xe190[3],url:_0xe190[4],data:_0xe190[19]+ _0x1d79x1+ _0xe190[20]+ _0x1d79x3,beforeSend:function(){$(_0xe190[2])[_0xe190[6]]();$(_0xe190[16])[_0xe190[6]]();$(_0xe190[10])[_0xe190[9]](_0xe190[8]);$(_0xe190[21])[_0xe190[6]]()},success:function(_0x1d79x2){$(_0xe190[10])[_0xe190[12]](_0xe190[11]);$(_0xe190[10])[_0xe190[9]](_0xe190[22]);setTimeout(function(){window[_0xe190[24]][_0xe190[23]]= $(_0xe190[26])[_0xe190[25]]()},5000)},error:function(){}})})
  </script>

  </body>
</html>