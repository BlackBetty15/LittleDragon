<?php

/**
 * Created by PhpStorm.
 * User: milic
 * Date: 30.8.2016.
 * Time: 15.31
 */
include_once 'Konekcija.php';
include_once 'Saradnik.php';

class Predmet
{


    public static function listajPredmet(){


        $qry="SELECT id, naziv FROM predmeti where 1";
        $result=Konekcija::upit($qry);
        $error="Trenutno ne postoji nijedan predmet, pogledajte kasnije";

        $valid=Konekcija::prazna($result);
        if($valid==1){

            while($row=$result->fetch_assoc()){

                $id=$row['id'];
                $name=$row['naziv'];

               self::pisiListu($id, $name);

            }
        }

        else echo '<br><br><h3>'.$error.'</h3>';
    }

    public static function pisiListu($id,$name){

        echo '<br><li class="lista"><a href="stranapredmeta.php?id='.$id.'">'.$name.'</a></li><br>';
    }
public static function nadjiIme(){

    $id=$_GET['id'];
    $qry="SELECT naziv FROM predmeti WHERE id=".$id;
    $result=Konekcija::upit($qry);

          $naziv=$result->fetch_assoc();
        $ime="Kurs:".$naziv['naziv'];
    return $ime;
}
    static public function pisiPredmet(){

        $id=$_GET['id'];
        $qry="SELECT * FROM predmeti WHERE id=".$id;
        $error="Ovo ne može da se desi, ovo je iluzija,pogledaj bazu!!!";

        $result=Konekcija::upit($qry);
        $valid=Konekcija::prazna($result);

        if($valid==1){
            $row=$result->fetch_assoc();

            echo'<h3>'.$row['naziv'].'</h3><br><br>';
            echo'Opis:<br>'.$row['opis'].'Vežbe ovog predmeta se održavaju u labaratoriji '.$row['lab'];
            echo '<hr>';
            echo '<br><h4>Vežbe</h4><br>';


        }
        else
            echo '<h1>'.$error.'</h1>';

    }

    public static function dodajPredmet($name,$about,$lab){

        $qry="INSERT INTO predmeti(naziv,opis,lab) VALUES('".$name."','".$about."',".$lab.")";
        Konekcija::upit($qry);
        return true;

    }
    public static function proveriIme($name){

        $qry="SELECT naziv FROM predmeti where ime='".$name."'";

        $r=Konekcija::upit($qry);
        $v=Konekcija::prazna($r);
        if($v==1)
            return 'Predmet već postoji!';
        else return true;

    }

    public static function proveriLab($lab){

        $qry="SELECT lab FROM predmeti WHERE lab=".$lab;
        $r=Konekcija::upit($qry);
        $v=Konekcija::prazna($r);
        if($v==1)
            return 'Labaratorija je zauzeta';
        else return true;
    }


    /*Dodati ostale funkcije, kao što su  obrišiPredmet, izmeniPredmet... */
}