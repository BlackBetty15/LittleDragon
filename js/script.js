



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
/*Validacija forme*/
/*
function validateForm(){

    var userPolje=document.getElementById('username');
    var passPolje=document.getElementById('password');

    var korisnik=document.getElementById('username').value;
    var lozinka=document.getElementById('password').value;


    if(korisnik==""&&lozinka==""){

        alert('Morate prvo popuniti polja');
        userPolje.style.border='1px solid red';
        userPolje.style.background='#F4B7A5';
        passPolje.style.border='1px solid red';
        passPolje.style.background='#F4B7A5';

        return false;
    }

    else if(korisnik==""){
        alert('Niste uneli korisničko ime');
        userPolje.style.border='1px solid red';
        userPolje.style.background='#F4B7A5';

        return false;
    }

    else if(lozinka==""){

        alert('Niste uneli lozinku');
        passPolje.style.border='1px solid red';
        passPolje.style.background='#F4B7A5';

        return false;

    }
    else{

        return true;
    }

}

*/
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
}
