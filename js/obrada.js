$("body").on("click","#dodajPredmet",function() {
    //
    var opisPredmeta= document.getElementById('opis').value;
    var nazivPredmeta = document.getElementById("subjectname").value;
    var brLab= document.getElementById("labbr").value;

    var labError="Laboratorija je zauzeta";
    var predmetError="Predmet već postoji";
    var emptyError="Morate popuniti sva polja označena *.";
    var unknownError="Došlo je do neke greške, pokušajte kasnije";
    var uspesno="Predmet je uspešno dodat";

    alert(brLab);
    alert(nazivPredmeta);


    var u_redu1;
    var u_redu2;

    // moze biti problem relativna adresa
    $.get(
        "ajax/obrada.php?idZahtev=1&naziv="+nazivPredmeta.toLowerCase()+"",
        {},
        function(odgovor,status)
        {
            alert(odgovor + status);


            if( odgovor==1) {//ako posoji predmet
                document.getElementById("poruka").style.color="red";
                document.getElementById("poruka").innerHTML=predmetError;
                u_redu1 = 0;
            }//necemo da ubacimo
            else
                u_redu1 = 1; //sve regularno
        });



    $.get(
        "ajax/obrada.php?idZahtev=2&labbr="+parseInt(brLab)+"",
        {},
        function(odgovor,status){
            alert(odgovor+status);


            if( odgovor==1)//ako je zauzeta
            {document.getElementById("porukalab").style.color="red";
                document.getElementById("porukalab").innerHTML=labError;
                u_redu2 = 0; }//necemo da ubacimo
            else
                u_redu2 = 1; //sve regularno
        });

    if(u_redu1==1 && u_redu2==1)
    {
        $.get(
            "ajax/dodaj.php?idZahtev=1&naziv="+nazivPredmeta+"&opis="+opisPredmeta+"&lab="+brLab+"",
            function(odgovor,status)
            {
                if(odgovor==0){

                    document.getElementById("porukalab").style.color="red";
                    document.getElementById("porukalab").innerHTML=emptyError;
                }
                else if(odgovor==1){
                document.getElementById("porukalab").style.color="green";
                document.getElementById("porukalab").innerHTML=uspesno;
                }
                else{
                    document.getElementById("porukalab").style.color="red";
                    document.getElementById("porukalab").innerHTML=unknownError;
                }
            });
    }


});

/*1 i 2 su za proveru lab. i predmeta, 3 je za login*/

