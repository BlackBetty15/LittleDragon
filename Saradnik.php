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

    $qry="SELECT id, ime, prezime FROM korisnici where tip=2";
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

            echo '<img src="img/user.png" id="imgsaradnik">';
            echo'<h3 id="naslov" class="textsaradnik">'.$row['zvanje'].' '.$row['ime'].' '.$row['prezime'].'</h3>';
            echo '<p id="mail" class="textsaradnik">Saradnika možete kontaktirati na mejl:<br><a href="mailto:" '.$row['mail'].'>'.
            $row['mail'].'</a></p>';

           echo '</div>';

            echo '<div id="bio">';

                    echo '<br><br><p>Biografija:<br>'.$row['bio'].'</p>';

            echo '</div><hr><br><h4>Predmeti na kojima je saradnik aktivan:</h4><br>';
            self::aktivanNa($id);
            echo '<hr>';

        }
        else
            echo '<h1>'.$error.'</h1>';

    }

        public function aktivanNa($id){

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


}