/**
 * Created by milic on 24.8.2016..
 */



/*prikaz forme za logovanje*/
function prikazi(){
    document.getElementById('toggle_action').style.visibility='visible';
}

function sakrij(){
    document.getElementById('toggle_action').reset(); /* Čisti input polja*/
    document.getElementById('toggle_action').style.visibility='hidden';
}
/*
function validateForm(){

    //var user= document.forms['login']['usr'].value;
    //var pass= document.forms['login']['psd'].value;

    var user = document.getElementById("username").value;
    var pass = document.getElementById("password").value;

    if((user==" ")&&( pass==" ")){

        alert("Morate popuniti polja");
        //document.getElementById("toggle_action").style.visibility="visible";
        document.getElementById('username').style.border='#561D25';
        document.getElementById('password').style.border='#561D25';
        user.focus();
        return false;

    }
    else if(user==" "){
        alert("Morate uneti korisničko ime");
        document.getElementById('username').style.border='#561D25';
        user.focus();
        return false;

    }
    else if (pass==" "){
        alert("Morate uneti lozinku");
        document.getElementById('password').style.border='#561D25';
        pass.focus();
        return false;


    }
    else return true;

}

function proba(){
    alert("proba");
    var status =  validateForm();
    if(status == false)
        alert("Prazna polja");
    else
        alert(document.getElementById("username").value);
}*/

