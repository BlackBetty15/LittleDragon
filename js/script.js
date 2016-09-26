



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
            window.location.href='index.php';
        }
    );
    return false;
});

$("body").on("click","#dodajS",function(){

    function _(el)
    {
        return document.getElementById(el);
    }


        var fileN = _("file").files[0];
        // alert(file.name+" | "+file.size+" | "+file.type);
        var formdata = new FormData();
        formdata.append("file", fileN);
        var ajax = new XMLHttpRequest();

        ajax.open("POST", "ajax/dodaj.php?idZahtev=1");
         ajax.send(formdata);

        alert(ajax.responseText);

});
