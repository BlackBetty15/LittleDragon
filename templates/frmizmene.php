
<form  action="ajax/dodaj.php" method="post"   id="tglaction" name="dodaj" style="display: none
" enctype="multipart/form-data">
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

    </table>


</form>