<?php

class configuracion {
   private $host = '';
   private $user = '';
   private $pass = '';
   private $apli = '';
   
   private $home = '/opt/lampp/htdocs/Cuentas/';
   
   public function getHost() { return $this->host; }
   public function getUser() { return $this->user; }
   public function getPass() { return $this->pass; }
   public function getApli() { return $this->apli; }
   
   public function getHome() { return $this->home; }

   public function __construct   () {
        if (file_exists('/opt/lampp/htdocs/claves.json')) {
            $config = json_decode(file_get_contents('/opt/lampp/htdocs/claves.json'), true);
            $config = $config["Cuentas"];
            
            $this->host        = $config["host"];
            $this->user        = $config["user"];
            $this->pass        = $config["pass"];
            $this->apli        = $config["apli"];

            $this->home        = $config["home"];

        } elseif (getenv('DB_HOST')) {
            $this->host        = getenv('DB_HOST');
            $this->user        = getenv('DB_USER');
            $this->pass        = getenv('DB_PASS');
            $this->apli        = getenv('DB_APLI');

            $this->home        = getenv('FL_HOME');
        }
        echo var_export($this, true);
    }
}

$modeloConfiguracion = new configuracion();

?>
