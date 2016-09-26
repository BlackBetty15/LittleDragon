<div>
    <form  action="" method="post"  id="tglaction" name="dodaj" style="display: none
">
        <table class="frmlab">
            <tr>
                <td>
                    <label for="ime">Ime*</label>
                </td>
                <td>
                    <input type="text" id="ime" name="ime" class="obavezno" autofocus >

                </td>
            </tr>
            <tr>
                <td>
                    <label for="prezime">Prezime*</label>
                </td>
                <td>
                    <input type="text"  id="prezime" name="prezime" class="obavezno">
                </td>

            </tr>
            <tr>
                <td>
                    <label for="zvanje">Zvanje</label>
                </td>
                <td>
                    <select id="zvanje">
                        <option></option>
                        <option>dipl. inž.</option>
                        <option>spec.</option>
                        <option>prof.</option>
                        <option>dr</option>
                        <option>mr</option>
                        <option>inž.</option>
                    </select>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="mejl">E-mail*</label>
                    <input type="checkbox" id="mailCheck"  disabled >
                </td>
                <td>
                    <input type="email"  id="mejl" name="mejl"  class="obavezno" class="cekirano" maxlength="45" placeholder="example@viser.edu.rs">
                    <p id="errorMail" class="poruka"></p>
                </td>


            </tr>
            <tr>
                <td>
                    <label for="korisnickoi">Korisničko ime*</label>
                    <input type="checkbox" id="checkUser" disabled>
                </td>
                <td>
                    <input type="text"  id="korisnickoi" name="korisnicko" class="obavezno" class="cekirano"  maxlength="20">
                    <p id="errorKorisnicko" class="poruka"></p>
                </td>


            </tr>
            <tr>
                <td>
                    <label for="lozinka">Lozinka*</label>

                </td>
                <td>
                    <input type="password"  id="lozinka" name="lozinka" class="obavezno"  maxlength="20">
                    <p id="errorLozinka" class="poruka"></p>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="biografija">Biografija</label>
                </td>
                <td>
                    <textarea  id="biografija" name="biografija"></textarea>
                </td>

            </tr>

            <tr >
                <td colspan="2">
                    <p id="errormsg" class="poruka"></p>
                </td>
            </tr>


            <tr>

                <td>
                    <input type="reset" value="Obriši" id="saradnikBrisi">
                </td>
                <td>

                    <input type="button" id="dodajSaradnika" value="Dodaj saradnika">
                </td>
            </tr>
        </table>


    </form>
</div>







