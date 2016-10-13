<?php

/**
 * Created by PhpStorm.
 * User: milic
 * Date: 24.8.2016.
 * Time: 18.42
 */
include_once "Konekcija.php";
include_once "Predmet.php";
class Saradnik{

    public static function listajSaradnike(){

    $qry="SELECT id, ime, prezime FROM korisnici where tip=2 && aktivan=1";
    $result=Konekcija::upit($qry);
    $error="Trenutno ne postoji nijedan saradnik, pogledajte kasnije";

    $valid=Konekcija::prazna($result);
    if($valid==1){

        while($row=$result->fetch_assoc()){

            $id=$row['id'];
            $name=$row['ime']." ".$row['prezime'];

            self::pisiListu($id, $name);

            }
     }
    else  echo '<br><br><h3>'.$error.'</h3>';
    }

    public function pisiListu($id,$name){

        echo '<br><li class="lista"><a href="stranasaradnik.php?id='.$id.'">'.$name.'</a></li><br>';

    }

    public static function pisiSaradnika(){


        $id=$_GET['id'];
        $qry="SELECT * FROM korisnici WHERE id=".$id;
        $error="Ovo ne može da se desi, ovo je iluzija,pogledaj bazu!!!";

        $result=Konekcija::upit($qry);
        $valid=Konekcija::prazna($result);

        if($valid==1){
           $row=$result->fetch_assoc();

           echo '<div id="saradnik" class="clearFix">';
                    if($row['slika']==NULL || $row['slika']==""){
            echo '<img src="img/user.png" id="imgsaradnik">';
                    }
            else
            echo'<img src="'.$row['slika'].'"'.'id="imgsaradnik">';
            echo'<h3 id="naslov" class="textsaradnik">'.$row['zvanje'].' '.$row['ime'].' '.$row['prezime'].'</h3>';
            echo '<p id="mail" class="textsaradnik">Saradnika možete kontaktirati na mejl:<br><a href="mailto:" '.$row['mail'].'>'.
            $row['mail'].'</a></p>';

           echo '</div>';

            echo '<div id="biografijaS">';

                    echo '<br><br><p>Biografija:<br>'.$row['bio'].'</p>';
                        if(isset($_SESSION['tip'])){

                        }



        }
        else
            echo '<h1>'.$error.'</h1>';

    }

        public static function aktivanNa($id){

            $error='Saradnik nije angažovan ni na jednom predmetu';
            $qry="SELECT id, naziv FROM predmeti WHERE id IN (
                            SELECT idpredmet FROM predaje WHERE idsaradnik=".$id." AND aktivan=1)";

            $result=Konekcija::upit($qry);

            $validacija=Konekcija::prazna($result);
            if($validacija==1){

                while($row=$result->fetch_assoc()){

                    $naziv=$row['naziv'];
                    $idp=$row['id'];
                    Predmet::pisiListu($idp,$naziv);
                }
            }
            else echo $error;

        }
    public static function sviSaradnici(){

        $qry="SELECT username,pass,mail FROM korisnici";
        $result=Konekcija::upit($qry);
        $nizSvih=[];


            while($red = $result->fetch_assoc())
            {
                array_push($nizSvih,$red);
            }
        return $nizSvih;
    }

public static function dodajSaradnika($username,$pass,$ime,$prezime,$mail,$bio,$zvanje){

    $tip=2;
    $aktivan=1;

    $qry="INSERT INTO korisnici(username,pass,tip,ime,prezime,aktivan,mail,bio,zvanje)
    VALUES ('".$username."','".$pass."',$tip,'".$ime."','".$prezime."',$aktivan,'".$mail."','".$bio."','".$zvanje."')";

    $status=Konekcija::upit($qry);
    return $status;
}


    public static function dodajBiografiju($nova,$id){

        $qry="UPDATE korisnici SET bio='".$nova."' WHERE id=".$id;

        $status=Konekcija::upit($qry);

        return $status;

    }

    public static function getBio($id){

        $qry="SELECT bio FROM korisnici WHERE id=".$id;
        $status=Konekcija::upit($qry);

        $status->fetch_assoc();

        return $status;
    }

    public static function mojPredmet($idP,$idS){

        $qry="SELECT * FROM predaje WHERE idpredmet=".$idP." AND idsaradnik=".$idS." AND aktivan=1";


        $result=Konekcija::upit($qry);


        if($result){

            $v=Konekcija::prazna($result);
            if($v==1){
                return 1;
            }
            else return 0;
        }


    }

    public static function promeniLozinku($pass,$id){

        $qry="UPDATE korisnici SET pass='".$pass."' WHERE id=".$id;
        $status=Konekcija::upit($qry);
        return $status;

    }

    public static function dodajSliku($idS,$src){

        $qry="UPDATE korisnici SET slika='".$src."' WHERE id=".$idS;
        $status=Konekcija::upit($qry);
        return $status;

    }

    public static function obrisiKorisnika($idS){

        $qry1="DELETE  FROM angazovan WHERE idsaradnik=".$idS;
        $qry2="DELETE  FROM predaje WHERE idsaradnik=".$idS;
        $qry3="DELETE  FROM korisnici WHERE id=".$idS;

        $status1=Konekcija::upit($qry1);
        $status2=Konekcija::upit($qry2);
        $status3=Konekcija::upit($qry3);

        $final=($status1&&$status2&&$status3);

        return $final;
    }

    public static function deaktivirajKorisnika($idS){

        $qry1="UPDATE angazovan SET aktivan=0 WHERE idsaradnik=$idS";
        $qry2="UPDATE predaje SET aktivan=0 WHERE idsaradnik=$idS";
        $qry3="UPDATE  korisnici SET aktivan=0 WHERE id=$idS";

        $status1=Konekcija::upit($qry1);
        $status2=Konekcija::upit($qry2);
        $status3=Konekcija::upit($qry3);

        $final=($status1&&$status2&&$status3);

        return $final;
    }

    public static function deaktivirani(){

        $qry='SELECT id,ime,prezime FROM korisnici WHERE aktivan=0';
        $result=Konekcija::upit($qry);
        while($row=$result->fetch_assoc()){
            $idbr=$row['id'];
            $ime=$row['ime'];
            $prezime=$row['prezime'];
            echo '<option value="'.$idbr.'">'.$ime.' '.$prezime.'</option>';
        }

    }
    public static function aktiviraj($idS){

        $qry1="UPDATE angazovan SET aktivan=1 WHERE idsaradnik=$idS";
        $qry2="UPDATE predaje SET aktivan=1 WHERE idsaradnik=$idS";
        $qry3="UPDATE  korisnici SET aktivan=1 WHERE id=$idS";

        $status1=Konekcija::upit($qry1);
        $status2=Konekcija::upit($qry2);
        $status3=Konekcija::upit($qry3);

        $final=($status1||$status2||$status3);

        return $final;

    }

    public static function dodajSrNaVezbu($idV,$idS){

        $qry="INSERT INTO angazovan (idvezbe, idkorisnik, aktivan) VALUES ($idV,$idS,1)";
        $status=Konekcija::upit($qry);
        return $status;

    }

    public static function mojiSaradnici($idP){

        $qry='SELECT id,ime,prezime,zvanje FROM korisnici WHERE id IN(SELECT idsaradnik FROM predaje WHERE idpredmet='.$idP.')';
        $result=Konekcija::upit($qry);

        while($row=$result->fetch_assoc()){
            $id=$row['id'];
            $ime=$row['ime'];
            $prezime=$row['prezime'];

            echo'<option value="'.$id.'">'.$ime.' '.$prezime.'</option>';

        }
    }

    public static function listaUklanjanjeS($idV){

        $qry='SELECT id,ime,prezime FROM korisnici WHERE id IN (SELECT idkorisnik FROM angazovan WHERE  idvezbe='.$idV.' AND aktivan=1)';
        $result=Konekcija::upit($qry);

        while($row=$result->fetch_assoc()){
            $id=$row['id'];
            $ime=$row['ime'];
            $prezime=$row['prezime'];
            echo'<option value="'.$id.'">'.$ime.' '.$prezime.'</option>';
        }

    }
    public static function ukloniSaVezbe($idS,$idV){

        $qry="UPDATE angazovan SET aktivan=0 WHERE idvezbe=$idV AND idkorisnik=$idS";
        $status=Konekcija::upit($qry);
        return $status;
    }

    public static function isActivV($idS,$idV){
        $qry="SELECT aktivan FROM angazovan WHERE idvezbe=$idV AND idkorisnik=$idS";
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

    public static function aktivirajV($idS,$idV){
        $qry="UPDATE angazovan SET aktivan=1 WHERE idvezbe=$idV AND idkorisnik=$idS";
        $status=Konekcija::upit($qry);
        return $status;
    }

    public static function mojiPredavaci($idV){
        $qry="SELECT id,ime,prezime,zvanje FROM korisnici WHERE id IN(SELECT idkorisnik FROM angazovan WHERE idvezbe=$idV AND aktivan=1)";
        $error="Na vežbi nije angažovan nijedan saradnik";

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


}