<?php

  class modeloEnlace {
    private $anterior;
    private $enlace;
    private $menu;
    private $scroll;
    private $extra;
    
    function getEnlace() { return $this->enlace; }
    function getAnterior() { return $this->anterior; }
    function getMenu() { return $this->menu; }
  	function getScroll() { return $this->scroll; }
  	function getExtra() { return $this->extra; }
    
    function setEnlace($link, $scroll=0, $extra=NULL) {
    	$this->anterior = $this->enlace;
    	$this->enlace = $link;
    	$this->scroll = (isset($scroll))?$scroll:0;
    	$this->extra = $extra;
    	
    	switch ($link) {
    		case 'ListadoMovimiento':
    		case 'CargaMovimento':
    		case 'CreaRecordatorio':
    		case 'AsignaEtiqueta':
    		case 'AsignaEtiquetaSplit':
    		case 'CambiaNombre':
    		case 'Split':
    		case 'CargaObligaciones':
    			$this->menu = 'Movimiento';
    			break;
    		case 'GestionaMovimiento':
    			$this->menu = 'Carga';
    			break;
    		case 'GestionaEtiqueta':
    		case 'GestionaTarjetas':
    		case 'EliminaMovimiento':
    		case 'GestionaPiso':
    		case 'GestionaPropietario':
    			$this->menu = 'Maestro';
    			break;
    		case 'VerEstadistica':
    			$this->menu = 'Estadistica';
    	}
    	
    	$_SESSION['data']['enlace'] = array('anterior'=> $this->anterior,
    			                            'enlace'  => $this->enlace,
    			                            'menu'    => $this->menu,
    			                            'scroll'  => $this->scroll,
    										'extra'   => $this->extra
    	);
    }
    
    function __construct() {
    	if ($_SESSION['data']['enlace']['enlace']) {
    		$this->enlace = $_SESSION['data']['enlace']['enlace'];
    		$this->anterior = $_SESSION['data']['enlace']['anterior'];
    		$this->menu = $_SESSION['data']['enlace']['menu'];
    		$this->scroll = $_SESSION['data']['enlace']['scroll'];
    		$this->extra = $_SESSION['data']['enlace']['extra'];
    	} else {
    		$this->setEnlace('ListadoMovimiento',0);
    	}
    }
  	
  }
  $Enlace = new modeloEnlace();

?>