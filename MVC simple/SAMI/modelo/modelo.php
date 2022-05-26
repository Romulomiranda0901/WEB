<?php

class pacinete {

    public $nombre;
    public $apellido;
    public $edad;
    public $idseguro;
    public $numero;


    function __construct($n="", $a="", $e="", $s="",$nume="")
    {
        $this->nombre= $n;
        $this->apellido = $a;
        $this->edad = $e;
        $this->idseguro= $s;
        $this->numero = $nume;
    }
}

?>