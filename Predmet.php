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
            echo'<h4>Opis:</h4><br><p id="opisP">'.$row['opis'].'</p><br>Vežbe ovog predmeta se održavaju u laboratoriji '.$row['lab'];



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

    public static function izmeniOpis($opis,$idP){

        $qry="UPDATE predmeti SET opis='".$opis."' WHERE id=".$idP;
        $status=Konekcija::upit($qry);
        return $status;

    }
    public static function listaDodavanje(){

        $qry="SELECT id,naziv FROM predmeti WHERE 1";

        $result=Konekcija::upit($qry);

        while($row=$result->fetch_assoc()){

            echo'<option>'.$row['naziv'].'</option>';

        }
        return;
    }

    public static function dodajNaPredmet($idS,$idP){

        $qry="INSERT INTO predaje (idpredmet,idsaradnik,aktivan) VALUES($idP,$idS,1)";
        $status=Konekcija::upit($qry);
        return $status;

    }
    public static function isActive($idS,$idP){

        $qry="SELECT aktivan FROM predaje WHERE idpredmet=$idP AND idsaradnik=$idS";
        $result=Konekcija::upit($qry);


        if($result){

            $v=Konekcija::prazna($result);
            if($v==1){
                $row=$result->fetch_assoc();
                $aktivan=$row['aktivan'];

            }
            else $aktivan=3;
        }
        return $aktivan;
    }

    public static function nadjiId($naziv){

        $qry='SELECT id FROM predmeti WHERE naziv="'.$naziv.'"';
        $result=Konekcija::upit($qry);
        $row=$result->fetch_assoc();
        $id=$row['id'];
        return $id ;

    }
    public static function aktiviraj($idS,$idp){
        $qry="UPDATE predaje SET aktivan=1 WHERE idpredmet=$idp AND idsaradnik=$idS";
        $status=Konekcija::upit($qry);
        return $status;
    }

    public static function listaUklanjanje($idS){

        $qry="SELECT naziv FROM predmeti WHERE id IN (SELECT idpredmet FROM predaje WHERE idsaradnik=$idS AND aktivan=1)";
        $result=Konekcija::upit($qry);
        while($row=$result->fetch_assoc()){
            echo'<option >'.$row['naziv'].'</option>';
        }
        return;
    }
    public static function ukloni($idS,$idP){

        $qry="UPDATE predaje SET aktivan=0 WHERE idpredmet=$idP AND idsaradnik=$idS";
        $status=Konekcija::upit($qry);
        return $status;

    }

    public static function dodajNovuVežbu($naziv,$idpredmet,$datum,$materijal,$opis,$vreme){

    }

    public static function obrisiPredmet($idP){

        $qry1="DELETE * FROM vezba WHERE idpredmet=$idP";
        $qry2="DELETE * FROM predaje WHERE idpredmet=$idP";
        $qry3="DELETE * FROM predmeti WHERE id=$idP";

        $status1=Konekcija::upit($qry1);
        $status2=Konekcija::upit($qry2);
        $status3=Konekcija::upit($qry3);

        $final=($status1&&$status2&&$status3);

        return $final;

    }

    public static function obrisiVezbu($idV){

        $qry1="DELETE * FROM angazovan WHERE idvezbe=$idV";
        $qry2="DELETE * FROM vezba WHERE id=$idV";


        $status1=Konekcija::upit($qry1);
        $status2=Konekcija::upit($qry2);


        $final=($status1&&$status2);

        return $final;
    }
}