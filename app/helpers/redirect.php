<<?php

   /**
    * REDIRECIONA UM USUÁRIO PARA A URL INFORMADA E FINALIZA A APLICAÇÃO
    * @param string $url URL A SER DIRECIONADA
    * @return void
    */

   function redirect(string $url)
   {
      header('Location: ' . $url);
      exit;
   }
