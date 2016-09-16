<?php


include_once 'Konekcija.php';
include_once 'Saradnik.php';

class Predmet
{


    public static function listajPredmet(){


        $qry="SELECT id, naziv  FROM predmeti where 1";
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
            echo'Opis:<br>'.$row['opis'].'Vežbe ovog predmeta se održavaju u laboratoriji '.$row['lab'];
            echo '<hr>';
            echo '<br><h4>Vežbe</h4><br>';


        }
        else
            echo '<h1>'.$error.'</h1>';

    }

    public static function dodajPredmet($name,$about,$lab){

        $qry="INSERT INTO predmeti(naziv,opis,lab) VALUES('".$name."','".$about."',".$lab.")";
       $status = Konekcija::upit($qry);
        return $status;

    }


    public static function vratiSve()
    {
        $nizSvih = [];

        $rs = Konekcija::upit("SELECT naziv, lab FROM predmeti");

        while($red = $rs->fetch_assoc())
        {
            array_push($nizSvih,$red);
        }

        return $nizSvih;
    }

    /*Dodati ostale funkcije, kao što su  obrišiPredmet, izmeniPredmet... */
}