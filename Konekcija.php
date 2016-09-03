<?php

/**
 * Created by PhpStorm.
 * User: milica
 * Date: 10.8.2016.
 * Time: 17.26
 */

/*Upiti za bazu,konekcije...*/

include_once 'config.php';
class Konekcija
{

    private $con; /*konekcija*/
    private static $pok;

    /*Konekcija*/
    private function __construct() /*ako ne radi, vrati na public*/
    {

        $host = DB_HOST;
        $user = DB_USER;
        $name = DB_NAME;
        $pass = DB_PASS;

        $this->con = @mysqli_connect($host, $user, $pass, $name)
        OR /*@ ne prikazuje ništa u browser-u*/
        die('Konekcija sa bazom nije uspela' . mysqli_connect_error());/*U slučaju greške prilikom konekcije*/

        mysqli_set_charset($this->con, 'utf8_unicode_ci');

    }

    /*Instanca baze, pokazivač na konekciju*/

    public static function pokazivacKon(){

        if( self::$pok ==null )
            self::$pok = new Konekcija();

        return self::$pok;

    }

    /*nalaženje konekcije baze na koju pokazuje pokazivač*/
    public function getKonekcija()
    {
        if(  $this->con == null )
        {
            self::pokazivacKon();
        }
        return $this->con;
    }


    public static function login($usr,$psd){


        $qry="SELECT * FROM korisnici WHERE username= '".$usr."' AND pass= '".$psd."'";

        $results = Konekcija::upit($qry);
        $error="Nema đokice"; /* Sredi đokicu*/

            $validacija=self::prazna($results);
            if($validacija==1){

           return $results->fetch_assoc();
            }
            else
                return $error;


    }
    public static function upit($query){

        return   Konekcija::pokazivacKon()->getKonekcija()->query($query); /*pokazivač na konekciju*/

        /*pazi na fetch, nema ga kod update-a i sličnih funkcija*/

    }

    /*Preusmeravanje stranice apsolutnom putanjom*/
    public static function redirectUser($page){

        $url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
        /*Dodeljuje se ime hosta(domaćina) a zatim postavlja u tekući direktorijum, a to je direktorijum iz kog se poziva funkcija*/

        $url=trim($url,'/\\'); /*uklanja kose crtne na kraju*/

        $url.='/'.$page; /*dodaje ime stranice na koju preusmeravamo*/

        header('Location:'.$url);/*Preusmeravanje*/
        exit(); /*Prekida izvršavanje skripta*/

    }

    public static function prazna($result){  /*proverava da li je rezultat upita prazan, odnosno, nula redova */
        if($result->num_rows===0)
                                        /*identički proverava broj redova koje upit vraća*/
            return 0;    /*vraća nulu ako je prazan*/
        else
            return 1;
    }

    public function __destruct() /*Kaaaboooom! No more base */
    {
        @mysqli_close($this->con) OR die('Greška prilikom diskonekcije');
    }

}