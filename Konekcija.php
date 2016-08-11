<?php

/**
 * Created by PhpStorm.
 * User: milica
 * Date: 10.8.2016.
 * Time: 17.26
 */

/*Upiti za bazu, greške, konekcije...*/

class Konekcija
{
    private $con; /*konekcija*/
    private $host;
    private $user;
    private $pass;
    private $name;
    /*Konekcija*/
            public function __construct($host,$user,$pass,$name){
                $this->host=$host;
                $this->name=$name;
                $this->pass=$pass;
                $this->user=$user;
            $this->con= @mysqli_connect($this->host,$this->user,$this->pass,$this->name) OR /*@ ne prikazuje ništa u browser-u*/
            die('Konekcija sa bazom nije uspela'.mysqli_connect_error($this->con));/*U slučaju greške prilikom konekcije*/




                                                }
}