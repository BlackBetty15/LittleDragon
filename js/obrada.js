


            //Dodavanje predmeta//

$("body").on("click","#dodajPredmet",function() {
    //
     opisPredmeta= $('#opis').val();
     nazivPredmeta = $("#subjectname").val();
     brLab= $("#labbr").val();

     labError="Laboratorija je zauzeta";
     predmetError="Predmet već postoji";
     emptyError="Morate popuniti sva polja označena *.";
     unknownError="Došlo je do neke greške, pokušajte kasnije";
     uspesno="Predmet je uspešno dodat";

      porukaL=$("#porukalab");
      porukaP=$("#poruka");

    alert(brLab);
    alert(nazivPredmeta);


    if(nazivPredmeta==""||brLab==""){

        porukaL.css('color','red');
        porukaL.html(emptyError);

    }

    // moze biti problem relativna adresa
    else{
              $.get(
                    "ajax/obrada.php?idZahtev=1&naziv="+nazivPredmeta+"&opis="+opisPredmeta+"&lab="+parseInt(brLab)+"",
                        {},
                        function(odgovor,status){

                                            alert(odgovor + status);

                                              //Ako su već postoji predmet i lab. je zuzeta
                                              if(odgovor==0){
                                                  porukaL.css('color','red');
                                                  porukaP.css('color','red');
                                                  porukaL.html(labError);
                                                  porukaP.html(predmetError);
                                              }
                                             else if(odgovor==1){
                                                  porukaL.css('color','green');
                                                  porukaL.html(uspesno);
                                                  porukaP.html("");

                                                  $('#listaP').load(document.URL +  ' #listaP');
                                              }
                                             else if(odgovor==2){

                                                  porukaP.css('color','red');
                                                  porukaL.html("");
                                                  porukaP.html(predmetError);
                                              }
                                              else if(odgovor==3){
                                                  porukaL.css('color','red');
                                                  porukaL.html(labError);
                                                  porukaP.html("");
                                              }
                                              else{
                                                  porukaL.css('color','red');
                                                  porukaL.html(unknownError);

                                              }

                    });

    }

});
                    //Dodavanje saradnika//


$("body").on("click","#dodajSaradnika",function(){

    //Varijable sa vrednostima iz inputa

    ime=$("#ime").val();
    prezime=$("#prezime").val();
    zvanje=$("#zvanje").val();
    mail=$("#mejl").val();
    usern=$("#korisnickoi").val();
    psd=$("#lozinka").val();
    bio=$("#biografija").val();

    obav=$(".obavezno"); //polja koja se moraju popuniti;
    cek=$(".cekirano"); //polja koja proveravaju validnost;
    /*da li je ok mejl i ostalo*/
    proveraMejl=$("#mailCheck").is(':checked');
    proveraUser=$("#checkUser").is(':checked');

    //Varijable sa poljima za greške

    glavnaPoruka=$("#errormsg");
  //  greskaMejla=$("#errorMail");
  //  greskaKorisnickog=$("#errorKorisnicko");

    //Ispisi grešaka

    emptyError="Morate popuniti sva polja označena *.";
    errorValid="Molim vas, unesite ispravne podatke.";
    unknownError="Došlo je do neke greške, pokušajte kasnije.";

    //Ostali ispisi
    uspesno="Saradnik je uspešno dodat.";



    //Proveravanje


    if(ime==""||prezime==""||mail==""||usern==""||psd==""){
        alert(ime);

        obav.css('border','1px solid red');

        glavnaPoruka.css('color','red');
        glavnaPoruka.html(emptyError);

    }


    else {

        if (proveraMejl && proveraUser) {


            $.post(
                "ajax/obrada.php?idZahtev=2",
                {name: ime, Lname: prezime, degree: zvanje, email: mail, user: usern, pass: psd, biog: bio},
                function (odgovor, status) {

                    alert(odgovor + status);

                    if (odgovor == 1) {
                        glavnaPoruka.css('color', 'green');
                        obav.css('border','1px solid #A9A9A9');
                        glavnaPoruka.html(uspesno);
                        $("#listaS").load(document.URL + ' #listaS');
                    }
                    else {
                        glavnaPoruka.css('color', 'red');
                        glavnaPoruka.html(unknownError);
                    }

                }
            );
        }

        else{
            glavnaPoruka.css('color','red');
            glavnaPoruka.html(errorValid);
            cek.css('color','red');

        }
    }

});

//Provera korisničkog imena//

$("#korisnickoi").change(function(){

   user=$("#korisnickoi").val();
   box=$("#checkUser");
   boxError=$("#errorKorisnicko");
   /*error msgs*/
    userExist="Korisničko ime je zauzeto, izaberite neko drugo.";

      $.post(

                    "ajax/provere.php?idZahtev=1",
                    {korisnicko:user},
                    function(odgovor,status){

                        alert(odgovor+status);

                        if(odgovor==1){
                            boxError.css('color','red');
                            boxError.html(userExist);
                        }
                        else if(odgovor==-1){
                            box.prop('checked',false);
                        }
                        else{
                            boxError.html("");
                            box.prop('checked', true);
                        }


                    });

            });

            //Provera mejla//
 $("#mejl").change(function(){

     mail=$("#mejl").val();
     check=$("#mailCheck");
    error=$("#errorMail");

     //error msgs//

     mailExist="Korisnik koji koristi ovaj e-mail već postoji u bazi. Molim vas, dodajte drugog korisnika.";
     mailNotValid="Niste uneli validnu formu e-maila.";
     mailError="Niste uneli nešto kako treba";

         $.post(
                "ajax/provere.php?idZahtev=2",
                 {email:mail},
                  function(odgovor,status){

                        alert(odgovor+status);
                        alert(status);

                      if(odgovor==0){
                          check.prop('checked',false);
                          error.css('color','red');
                          error.html(mailError);
                      }
                      else if(odgovor==1){
                          check.prop('checked',true);
                          error.html("");
                      }
                      else if(odgovor==2){
                          check.prop('checked',false);
                          error.css('color','red');
                          error.html(mailExist);
                      }
                      else if(odgovor==3){
                          check.prop('checked',false);
                          error.css('color','red');
                          error.html(mailNotValid);
                      }
                      else if(odgovor==-1){
                          check.prop('checked',false);
                          error.html("");
                      }
                    else{
                          error.html('doslo je do neke glupe greske');
                      }

                    });
  });


            //Izmena biografije//
$("body").on("click","#izmeniB",function(){


    novaBiografija=$("#bioNova").val();
    greska=$("#greskaBio");

    poruka="Došlo je do greške, pokušajte kasnije";

    $.post(
        "ajax/obrada.php?idZahtev=4",
        {bio:novaBiografija},
        function(odgovor,status){

            alert(odgovor+status);

            if(odgovor==1){

                $("#biografijaS").load(document.URL+ ' #biografijaS');

            }

            else {
                greska.css('color','red');
                greska.html(poruka);
            }

        }


    );


});
            //Izmena lozinke//

$("body").on("click","#izmeniL",function(){

    lozinka=$("#passNova").val();
    greska=$("#greskaLoz");

    poruka="Došlo je do greške, pokušajte kasnije";

    $.post(
        "ajax/obrada.php?idZahtev=5",
        {pass:lozinka},
        function(odgovor,status){

            alert(odgovor+status);

            if(odgovor==1){
                greska.css('color','green');
                greska.html("Vaša lozinka je uspešno promenjena.Sledeći put se ulogujte sa novom lozinkom");

            }
            else if(odgovor==-1){
                greska.css('color','red');
                greska.html('Ne smete ostaviti prazno polje za lozinku!');
            }
            else{
                greska.css('color','red');
                greska.html(poruka);
            }
        }
    );

});


            //Promena opisa predmeta///

$("body").on("click","#izmeniO",function(){

        noviO=$("#opisNova").val();

    $.post(
        "ajax/obrada.php?idZahtev=6",
        {opis:noviO},
        function(odgovor,status){

           alert(odgovor+status);

            if(odgovor==1){
                $("#opisP").load(document.URL+ ' #opisP');
            }
            else{
                $("#greskaO").css('color','red');
                $("#greskaO").html("Došlo je do greške, pokušajte kasnije");
            }


        });

            });
