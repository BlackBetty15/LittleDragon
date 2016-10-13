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



    public static function obrisiPredmet($idP){

        $qry1="DELETE  FROM vezba WHERE idpredmet=$idP";
        $qry2="DELETE  FROM predaje WHERE idpredmet=$idP";
        $qry3="DELETE  FROM predmeti WHERE id=$idP";

        $status1=Konekcija::upit($qry1);
        $status2=Konekcija::upit($qry2);
        $status3=Konekcija::upit($qry3);

        $final=($status1&&$status2&&$status3);

        return $final;

    }

    public static function obrisiVezbu($idV){

        $qry1="DELETE  FROM angazovan WHERE idvezbe=$idV";
        $qry2="DELETE  FROM vezba WHERE id=$idV";


        $status1=Konekcija::upit($qry1);
        $status2=Konekcija::upit($qry2);


        $final=($status1&&$status2);

        return $final;
    }

    public static function mojiSaradnici($idP){

        $qry="SELECT id,ime,prezime,zvanje FROM korisnici WHERE id IN(SELECT idsaradnik FROM predaje WHERE idpredmet=$idP)";
        $error="Na predmetu nije angažovan nijedan saradnik";

        $result=Konekcija::upit($qry);

        $v=Konekcija::prazna($result);

        if($v==0){
            echo $error;
        }
        if($v==1){
            while($row=$result->fetch_assoc()){
                $ime=$row['ime'];
                $prezime=$row['prezime'];
                $zvanje=$row['zvanje'];
                $id=$row['id'];

                echo'<li class="lista"><a href="stranasaradnik.php?id='.$id.'">'.$zvanje.' '.$ime.' '.$prezime.'</a></li>';
            }
        }


    }
    public static function dodajVezbu($idP,$naziv,$opis,$vreme,$datum){

        $qry='INSERT INTO vezba (naziv,idpredmet,datum,opis,vreme) VALUES ("'.$naziv.'",'.$idP.',"'.$datum.'","'.$opis.'",
                "'.$vreme.'")';

        $status=Konekcija::upit($qry);
        return $status;


    }
    public static function pisiVezbuZaPredmet($idP){
            $qry="SELECT * FROM vezba WHERE idpredmet=".$idP;

            $error="Trenutno nema nijedne vežbe na ovom predmetu";

            $result=Konekcija::upit($qry);
            $v=Konekcija::prazna($result);
            if($v==0){
                echo $error;
            }
        else{
            while($row=$result->fetch_assoc()){
                $datum=$row['datum'];
                $id=$row['id'];
                $nazivV=$row['naziv'];

                echo '<li class="lista"><a href="vezba.php?id='.$id.'">'.$nazivV.'('.$datum.')</a></li>';
            }
        }
    }

    public static function vratiImeV($idV){

        $qry='SELECT naziv FROM vezba WHERE id='.$idV;
        $result=Konekcija::upit($qry);

        $row=$result->fetch_assoc();
        return $row;
    }

    public static function ispisiVezbu($idV){

        $qry='SELECT * FROM vezba WHERE id='.$idV;
        $result=Konekcija::upit($qry);
        $row=$result->fetch_assoc();
        $opis=$row['opis'];
        $datum=$row['datum'];
        $vreme=$row['vreme'];

        echo '<h4>Opis vežbe:</h4><br><p id="opisVezbe">'.$opis.'</h4><br><br>';
        echo '<h4>Datum i vreme održavanja vežbe:</h4><p id="termin">'.$datum.' vreme:'.$vreme.'</p>';
    }
    public static function nadjiIdPredmeta($idV){

    $qry='SELECT idpredmet FROM vezba WHERE id='.$idV;
        $result=Konekcija::upit($qry);
        $row=$result->fetch_assoc();
        $id=$row['idpredmet'];
        return $id;

    }

    public static function promeniImeV($idV,$naziv){

        $qry='UPDATE vezba SET naziv="'.$naziv.'" WHERE id='.$idV;
        $status=Konekcija::upit($qry);
        return $status;
    }
    public static function promeniVremeV($idV,$vreme){
        $qry='UPDATE vezba SET vreme="'.$vreme.'" WHERE id='.$idV;
        $status=Konekcija::upit($qry);
        return $status;
    }
    public static function promeniOpisV($idV,$opis){
        $qry='UPDATE vezba SET opis="'.$opis.'" WHERE id='.$idV;
        $status=Konekcija::upit($qry);
        return $status;

    }
    public static function promeniDatumV($idV,$datum){

        $qry='UPDATE vezba SET datum="'.$datum.'" WHERE id='.$idV;
        $status=Konekcija::upit($qry);
        return $status;
    }
    public static function dodajMaterijal($idV,$url){

        $qry='UPDATE vezba SET materijal="'.$url.'" WHERE id='.$idV;
        $status=Konekcija::upit($qry);
        return $status;

    }

    public static function ispisMaterijala($idV){

        $qry='SELECT materijal FROM vezba WHERE id='.$idV;
        $error="Trenutno nema materijala za vežbu";
        $result=Konekcija::upit($qry);
        $v=Konekcija::prazna($result);
        if($v==0){

            echo $error;
        }
        else if($v==1){
            $row=$result->fetch_assoc();
            $link=$row['materijal'];

            if($link==null){
                echo $error;
            }
            else
            echo '<a href="'.$link.'">Materijal za vežbu</a>';
        }

    }
    public static function brisiMaterijal($idV){
        $qry='UPDATE vezba SET materijal="" WHERE id='.$idV;
        $status=Konekcija::upit($qry);
        return $status;
    }

    public static function vratiZaVežbu($min,$max){


        $qry='SELECT * FROM vezba WHERE datum BETWEEN "'.$min.'" AND "'.$max.'"';
        $result=Konekcija::upit($qry);

        while($row=$result->fetch_assoc()){

            $idV=$row['id'];
            $naziv=$row['naziv'];
            $idP=$row['idpredmet'];
            $time=$row['vreme'];
            $date=$row['datum'];
            $lab=self::lab($idP);
            $name=self::imeP($idP);


            echo '<h3>Predmet:</h3><br><a href="stranapredmeta.php?id='.$idP.'">'.$name.'</a><br>
            <p>Datum i vreme:'.$date.' '.$time.'</p><br><p>Laboratorija: '.$lab.'</p><br><a href="vezba.php?id='.$idV.'">
            '.$naziv.'</a><br>'
            ;



        }

    }
    public static function lab($idP){

        $qry='SELECT lab FROM predmeti WHERE id='.$idP;
        $result=Konekcija::upit($qry);
        $row=$result->fetch_assoc();
        $lab=$row['lab'];

        return $lab;
    }
    public static function imeP($idP){
        $qry='SELECT naziv FROM predmeti WHERE id='.$idP;
        $result=Konekcija::upit($qry);
        $row=$result->fetch_assoc();
        $name=$row['naziv'];

        return $name;
    }

    public static function imeS($idV){

        $qry='SELECT ime,prezime,zvanje,id FROM korisnici WHERE id=(SELECT idkorisnik FROM angazovan WHERE idvezbe='.$idV.')';
        $result=Konekcija::upit($qry);
        $row=$result->fetch_assoc();

        return '<a href="stranasaradnik.php?id='.$row['id'].'">'.$row['zvanje'].' '.$row['ime'].' '.$row['prezime'].'</a>';
    }
}