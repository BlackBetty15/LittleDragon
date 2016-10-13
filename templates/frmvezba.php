<div>
    <form   method="get"  id="frmvezba" name="dodaj">
        <table class="frmlab">
            <tr>
                <td>
                    <label for="vezbaIme">Ime vežbe*</label>
                </td>
                <td>
                    <input type="text" id="vezbaIme" name="vbn" class="obavezno"  >
                    <p id="porukaImena" class="poruka"></p>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="opisV">Opis vežbe</label>
                </td>
                <td>
                    <textarea  id="opisV" name="opisp"></textarea>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="datum">Datum vežbe  *</label>
                </td>
                <td>
                    <input type="text" id="datum" placeholder="gggg/mm/dd"  class="obavezno" >
                    <p id="porukaDatum" class="poruka"></p>
                </td>



            </tr>
            <tr>
                <td>
                    <label for="vreme">Vreme održavanja*</label>

                </td>
                <td>
                    <input type="text" id="vremeV" placeholder="hh:mm:ss" class="obavezno">
                    <p id="porukaVreme" class="poruka"></p>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p id="mainError"></p>
                </td>
            </tr>

            <tr>

                <td>
                    <input type="reset" value="Obriši" id="vezbaBrisi">
                </td>
                <td>

                    <input id="dodajVežbu" type="button" value="Dodaj vežbu">
                </td>

            </tr>
        </table>


    </form>
</div>