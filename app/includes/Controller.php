<?php

namespace Core;


Class Controller{

     
      public function ParamControl($pagina,$accion)
      {

      	$permalink = strtolower($accion);
        $router = new Router();

        if ($pagina == 'ajax'){
             require_once 'ajax.php';
        }


      // Para ver los detalles de la mesa}
      if ($pagina == 'mesa'){
          
           $router -> getTheHeader();

           // Menu del usuario
           MenuModulo();

           // Single de la mesa
           moduloMesaSingle($accion);
    
           $router -> getTheFooter();

      }

      if ($pagina == 'venta'){

           $router -> getTheHeader();

           // Menu del usuario
           MenuModulo();

           // Single de la venta
           displayVentaData($accion);
    
           $router -> getTheFooter();

      }

      if ($pagina == 'ticket'){
           showTicket($accion);
      }

      if ($pagina == 'cocina'){
          
           if ($accion == 'ordenes'){
             $router -> getTheHeader();
             ListOrdenesPerCate();
           }else{

           }

      }

    }
}