



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
