<?php
/**
 * Created by PhpStorm.
 * User: Dayanna
 * Date: 10/05/2019
 * Time: 12:27
 */
class bd_mysql{
    var $cnx;
    var $h;
    var $u;
    var $p;
    var $b;
    function __construct(){
        include_once('config.php');
        $this->h=$cfg['h'];
        $this->u=$cfg['u'];
        $this->p=$cfg['p'];
        $this->b=$cfg['b'];
    }
    function conectar(){
        $this->cnx=mysqli_connect($this->h,$this->u,$this->p,$this->b);
        mysqli_query($this->cnx,"set names utf8");
    }
    function consultar($sql=''){
        #select
        $this->conectar();
        $bolsa=mysqli_query($this->cnx,$sql);
        $datos=array();
        while($fila=mysqli_fetch_array($bolsa)){
            $datos[]=$fila;
        }
        return $datos;
    }
    function ejecutar($sql=''){
        #insert,update,delete
        $this->conectar();
        $exito=mysqli_query($this->cnx,$sql);
        return $exito;
    }
}
?>