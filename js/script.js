



/*prikaz forme za logovanje*/
function prikazi(){
    objekat=document.getElementById('toggle_action');
    objekat.style.visibility='visible';


}

function sakrij(){

    var objekat=document.getElementById('toggle_action');
    objekat.reset(); /* Čisti input polja*/
    objekat.style.visibility='hidden';


}

/*Toggle za formu*/




/*Validacija forme*/

function check(){

    var korisnicko=document.getElementById('username').value;
    var lozinka=document.getElementById('password').value;

    alert(korisnicko+" "+lozinka);

    var userPolje=document.getElementById('username');
    var passPolje=document.getElementById('password');

    var praznaPolja="Morate popuniti sva polja";
    var neispravno="Uneli ste neispravne podatke";

    if(korisnicko==""||lozinka==""){
        document.getElementById('errorlog').innerHTML=praznaPolja;
        userPolje.focus();
        userPolje.style.border='1px solid red';
        userPolje.style.background='#F4B7A5';
        passPolje.style.border='1px solid red';
        passPolje.style.background='#F4B7A5';

        return false;
    }

    else{
        $.post(

            "ajax/obrada.php",
            {idZahtev:3,usr:korisnicko,pas:lozinka},
            function(odgovor,status){
                alert(odgovor+status);
                var provera=odgovor;

                if(provera==-1){

                   alert(neispravno);
                    return false;
                }

                else if(provera==1){
                    return true;
                }
            return false;
            }


        );
    }

};
    /*Brisanje sadržaja polja na "otkaži"*/
$("body").on("click","#saradnikBrisi",function(){

    $(".obavezno").css('border','1px solid #A9A9A9');
    $("#errormsg").html("");


});

$("body").on("click","#predmetBrisi",function(){

    $(".obavezno").css('border','1px solid #A9A9A9');
    $("#poruka").html("");
    $("#porukalab").html("");

});
/*Toogle za forme*/
$("body").on("click","#frmtoggle",function(){
        $('#tglaction').toggle(2000);

        $(".obavezno").css('border','1px solid #A9A9A9');
        $("#errormsg").html("");

        $("#poruka").html("");
        $("#porukalab").html("");
        $(".poruka").html("");
        $(".lozinka").val('');

});
        //Dodavanje na predmet//

$("body").on("click","#dodajNaPredmet",function(){

    poruka=$("#porukaDodaj");
    predmet=$("#imePr").val();
    alert(predmet);
    postoji="Saradnik je već na predmetu";
    dodat="Saradnik je uspešno dodat na predmet";
    aktiviran="Saradnik je ponovo aktivan na predmetu";
    unknown="Došlo je do neke greške, pokušajte kasnije";

    $.post(
        "ajax/obrada.php?idZahtev=7",
        {naziv:predmet},
        function(odgovor,status){

            alert(odgovor+status);

            if(odgovor==0){
                poruka.css('color','red');
                poruka.html(postoji);
            }
            else if(odgovor==2){
                poruka.css('color','green');
                poruka.html(aktiviran);
                $("#listica").load(document.URL+' #listica');
                $("#ukloniP").load(document.URL+ ' #ukloniP');
            }
            else if(odgovor==3){
                poruka.css('color','red');
                poruka.html(unknown);
            }
            else if(odgovor==1){
                poruka.css('color','green');
                poruka.html(dodat);
                $("#listica").load(document.URL+' #listica');
                $("#ukloniP").load(document.URL+ ' #ukloniP');
            }


        });


});

            //Uklanjanje sa predmeta//

$("body").on("click","#ukloni",function(){

    ukloni=$("#imePrUkl").val();
    poruka=$("#porukaUkloni");

            //ispisi//

    unknown="Došlo je do neke greške, pokušajte kasnije";
    uspesno="Saradnik uspešno uklonjen";

    $.post(
       "ajax/obrada.php?idZahtev=8",
        {predmet:ukloni},
        function(odgovor,status){
            alert(odgovor+status);

            if(odgovor==1){
                poruka.css('color','green');

                $("#listica").load(document.URL+ ' #listica');
                $("#ukloniP").load(document.URL+ ' #ukloniP');

                poruka.html(uspesno);
            }
            if(odgovor==0){
                poruka.css('color','red');
                poruka.html(unknown);
            }

        });


});
        //Brisanje predmeta//
$("body").on("click","#deletetoggle",function(){

    $('#brisanje').toggle(1000);

});

$("body").on("click","#neBrisi",function(){

    $('#brisanje').css('display','none');
});

$("body").on("click","#obrisi",function(){

    $.get(
        "ajax/obrada.php?idZahtev=9",
        function(odgovor,status){
            alert(odgovor + " "+ status);
            window.location.href='predmeti.php';
        }
    );
    return false;
});
        //Brisanje saradnika//
$("body").on("click","#obrisiSaradnika",function(){


    $('#brisanjeS').toggle(1000);


});

$("body").on("click","#neBrisiS",function(){
    $('#brisanjeS').css('display','none');

});
$("body").on("click","#obrisiS",function(){

    $.get(
        "ajax/obrada.php?idZahtev=10",
        function(odgovor,status){
            alert(odgovor + " "+ status);
            window.location.href='saradnici.php';
        }
    );
    return false;

});

//Deaktivacija korisnika//
$("body").on("click","#deaktivirajS",function(){
    $("#deaktivS").toggle(1000);
});
$("body").on("click","#noDeactiv", function (){

    $("#deaktivS").css('display','none');

});
$("body").on("click","#deaktiviraj",function(){

    $.get(
        "ajax/obrada.php?idZahtev=11",
        function(odgovor,status){
            alert(odgovor+status);
            window.location.href='saradnici.php';
        }
    );
});
//Aktivacija korisnika//
$("body").on("click","#aktiviraj",function(){

    idS=$("#neaktivni").val();
    alert(idS);
    if(idS!=null){
    $.post(
        "ajax/obrada.php?idZahtev=12",
        {id:idS},
        function(odgovor,status){
            alert(odgovor+status);
            if(odgovor==1){
                $("#neaktivniS").load(document.URL + " #neaktivniS");
                $("#listaS").load(document.URL + " #listaS");
            }
        else
                alert("Došlo je do neke greške, pokuštajte kasnije");
        }
    );
    }
    else
        alert("Ne možete to sad uraditi");

});

            //Dodavanje vežbe//
$("body").on("click","#vezbaBrisi",function(){

    glavna=$("#mainError");
    obav=$(".obavezno");

    glavna.html('');
    obav.css('border','1px solid #A9A9A9');

});

$("body").on("click","#dodajVežbu",function(){

    naziv=$('#vezbaIme').val();
    opis=$('#opisV').val();
    datum=$('#datum').val();
    vreme=$('#vremeV').val();

    //greske//

    glavna=$("#mainError");
    obav=$(".obavezno");
    if(naziv==""||datum==""||vreme==""){

        glavna.css('color','red');
        glavna.html('Morate popuniti sva polja označena *');
        obav.css('border','1px solid red');
    }

    else{

        $.post(
            "ajax/obrada.php?idZahtev=13",
            {ime:naziv,opisV:opis,date:datum,time:vreme},
            function(odgovor,status){

                alert(odgovor+status);

                if(odgovor==1){
                    alert("Uspeštno ste dodali vežbu");

                    $("#listaVezbi").load(document.URL + ' #listaVezbi');
                    naziv.val('');
                    opis.val('');
                    datum.val();
                    vreme.val();

                }
                else{
                    alert("Došlo je do neke greške, molimo pokušajte kasnije");
                }
            }


        );
    }

});

$("body").on("click","#obrisiVezbu",function(){

    $("#brisanjeV").toggle(1000);
});
$("body").on("click","#neBrisiV",function(){

    $("#brisanjeV").css('display','none');

});

$("body").on("click","#obrisiV",function(){


    /*Ajaks za brisanje vežbe*/
    $.get(
        "ajax/obrada.php?idZahtev=14",
        function(odgovor,status){
            alert(odgovor + " "+ status);
            window.location.href='predmeti.php';
        }
    );
    return false;

});

//Dodavanje i brisanje sa
// radnika sa vežbe

//Brisanje//
$("body").on("click","#ukloniSaV",function(){

    idS=$("#ukloniSar").val();
        alert(idS);

    $.post(

        "ajax/obrada.php?idZahtev=15",
        {id:idS},
        function(odgovor,status){
            alert(odgovor+status);

            if(odgovor==1){

                $("#osvezi").load(document.URL + ' #osvezi');
                alert('Uspešno ste uklonili saradnika');
                $("#saradniciVezbe").load(document.URL+ ' #saradniciVezbe');
            }
            else
                alert('Došlo je do neke greške, molimo pokušajte kasnije');

        }

    );

});
//Dodavanja saradnika//
$("body").on("click","#dodajNaVezbu",function(){

    poruka=$("#porukaDodajV");
    saradnik=$("#imeSr").val();
    alert(saradnik);
    postoji="Saradnik je već na vežbi";
    dodat="Saradnik je uspešno dodat na vežbu";
    aktiviran="Saradnik je ponovo aktivan na vežbi";
    unknown="Došlo je do neke greške, pokušajte kasnije";

    $.post(

        "ajax/obrada.php?idZahtev=16",
        {id:saradnik},
        function(odgovor,status){

            alert(status+odgovor);
            if(odgovor==0){
                poruka.css('color','red');
                poruka.html(postoji);
            }
            else if(odgovor==2){
                poruka.css('color','green');
                poruka.html(aktiviran);
                $("#saradniciVezbe").load(document.URL + ' #saradniciVezbe');
                $("#osvezi").load(document.URL + ' #osvezi');
            }
            else if(odgovor==3){
                poruka.css('color','red');
                poruka.html(unknown);
            }
            else if(odgovor==1){
                poruka.css('color','green');
                poruka.html(dodat);
                $("#saradniciVezbe").load(document.URL + ' #saradniciVezbe');
                $("#osvezi").load(document.URL + ' #osvezi');
            }


        }
    );

});

//Izmena vežbe//
$("body").on("click","#izmeniMe",function(){

    $("#izmeniMeAk").toggle(2000);

});

//Izmena opisa//
$("body").on("click","#izmeniOpV",function(){

    opisN=$("#opisVN").val();

    $.post(
        "ajax/obrada.php?idZahtev=17",
        {novi:opisN},
        function(odgovor,status){

            if(odgovor==1){
                alert('Uspešno ste promenili opis vežbe');
                $("#opisVezbe").load(document.URL + ' #opisVezbe');

            }
            else
                alert('Došlo je do neke greške, molimo pokušajte kasnije');
        }
    );

});
$("body").on("click","#izmeniNaz",function(){

    nazivN=$("#noviNaziv").val();
    polje=$("#greskaNaziv");

    error="Ne možete ostaviti prazno polje za naziv!";

    if(nazivN==""){
        polje.css('color','red');
        polje.html(error);
    }
    else{

        $.post(

            "ajax/obrada.php?idZahtev=18",
            {novi:nazivN},
            function(odgovor,status){
                alert(odgovor+status);
                if(odgovor==1){

                    polje.html('');
                    $("#vezbica").load(document.URL + ' #vezbica');
                    alert('Uspešno ste promenili naziv vežbe');

                }
                else
                    alert('Došlo je do neke greške, molimo pokušajte kasnije');
            }

        );

    }
});
$("body").on("click","#izmeniDat",function(){

    datum=$("#noviDatum").val();
    polje=$("#greskaDate");
    error="Ne smete ostaviti prazno polje!";

    if(datum==""){
        polje.css('color','red');
        polje.html(error);
    }
    else{

        $.post(
            "ajax/obrada.php?idZahtev=19",
            {novi:datum},
            function(odgovor,status){
                alert(odgovor+status);
                if(odgovor==1){
                    alert('Uspešno ste promenili datum');
                    polje.html('');
                    $("#termin").load(document.URL + ' #termin');
                }
                else
                    alert('Došlo je do neke greške, molimo pokušajte kasnije');
            }
        );
    }

});
$("body").on("click","#izmeniVr", function(){

    vreme=$("#novoVreme").val();
    polje=$("#greskaTime");
    error="Ne smete ostaviti prazno polje!";

    if(vreme==""){
        polje.css('color','red');
        polje.html(error);
    }

    else{

        $.post(
            "ajax/obrada.php?idZahtev=20",
            {novi:vreme},
            function(odgovor,status){
                alert(odgovor+status);

            if(odgovor==1){
                alert('Uspešno ste izmenili vreme održavanja vežbi');
                polje.html('');
                $("#termin").load(document.URL + ' #termin');
            }
                else
                alert('Došlo je do neke greške, molimo pokušajte kasnije');

            }


        );
    }
});

$("body").on("click","#uklonimat",function(){

    $("#brisanjeM").toggle(1000);

});
$("body").on("click","#neBrisiM", function () {


    $("#brisanjeM").css('display','none');

});
$("body").on("click","#obrisiM",function(){


    $.get(
        "ajax/obrada.php?idZahtev=21",
        function(odgovor,status){
            alert(odgovor + " "+ status);
            if(odgovor==1){
                $("#materijal").load(document.URL + ' #materijal');
                $("#brisanjeM").css('display','none');
            }
            else
            {
                alert('Došlo je do neke greške, pokušajte kasnije');
            }
        }
    );
    return false;


});

$("body").on("change","#raspored",function(){

    nedelja=$("#raspored").val();

    $.post(
        "ajax/dodaj.php?idZahtev=1",
        {dan:nedelja},
        function(odgovor,status){

            $("#rasporedStampa").html(odgovor);
        }


    );


});