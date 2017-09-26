<?php

class configuracion {
   private $host = 'localhost';
   private $user = 'contador';
   private $pass = 'FhbqsXsGqfqLcSRW';
   private $apli = 'cuentas';
   
   private $home = '/opt/lampp/htdocs/cuentas/';
   
   public function getHost() { return $this->host; }
   public function getUser() { return $this->user; }
   public function getPass() { return $this->pass; }
   public function getApli() { return $this->apli; }
   
   public function getHome() { return $this->home; }
}

$modeloConfiguracion = new configuracion();

?>
