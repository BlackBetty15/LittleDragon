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
                    <label for="datum">Datum vežbe *</label>
                </td>
                <td>
                    <input type="date" id="datum"  class="obavezno" >
                    <p id="porukaDatum" class="poruka"></p>
                </td>



            </tr>

            <tr>
                <td>
                    <label for="vreme">Vreme održavanja vežbe *</label>
                </td>
                <td>
                    <input type="time" id="vreme"  class="obavezno" >
                    <p id="porukaVreme" class="poruka"></p>
                </td>



            </tr>

            <tr>
                <td>
                    <label for="fajlovi">Materijal</label>
                </td>
                <td>
                    <input type="file" id="fajlovi"  >
                    <p id="porukaDatum" class="poruka"></p>
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