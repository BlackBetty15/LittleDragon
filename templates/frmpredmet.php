<div>
<form   method="get"  id="tglaction" name="dodaj" style="display: none
">
        <table class="frmlab">
            <tr>
                <td>
                    <label for="subjectname">Ime predmeta*</label>
                </td>
                <td>
                    <input type="text" id="subjectname" name="sbn"   >
                    <p id="poruka"></p>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="opis">Opis predmeta</label>
                </td>
                <td>
                    <textarea  id="opis" name="opisp"></textarea>
                </td>

            </tr>
            <tr>
                <td>
                <label for="labbr">Laboratorija *</label>
                </td>
                <td>
                    <input type="text" id="labbr" name="lab" >
                    <p id="porukalab"></p>
                </td>



            </tr>
            <tr>

                <td>
                    <input type="reset" value="Obriši">
                </td>
                <td>

                    <input id="dodajPredmet" type="button" value="Dodaj predmet">
                </td>
            </tr>
        </table>


    </form>
</div>