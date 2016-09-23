
<form  action="" method="post"  id="tglaction" name="dodaj" style="display: none
">
    <table class="frmlab">

        <tr>
            <td>
                <label for="bioNova">Biografija:</label>

            </td>
            <td>
                <textarea cols="30" rows="6" id="bioNova" autofocus>

                </textarea>
                <!--Ubaci iz baze biografiju-->
            </td>
            <td>
                <input type="button" id="izmeniB" value="Promeni biografiju">
                <p id="greskaBio" class="poruka"></p>
            </td>
        </tr>

        <tr>

            <td>
                <label for="passNova">Nova lozinka:</label>
            </td>
            <td>
                <input type="password" id="passNova" class="lozinka">
                <p id="greskaLoz" class="poruka"></p>
            </td>
            <td>
                <input type="button" id="izmeniL" value="Promeni lozinku">
            </td>

        </tr>

        <tr>

            <td>
                <label for="slikaNova">Nova slika</label>
            </td>

            <td>

            </td>

            <td>
                <input type="button" id="izmeniS" value="Promeni Sliku">
            </td>
        </tr>




    </table>


</form>