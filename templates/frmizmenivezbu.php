<form  action="#" method="post"   id="izmeniMeAk" name="dodaj" style="display: none
" >
    <table class="frmlab">

        <tr>
            <td>
                <label for="opisVN">Opis vežbe:</label>

            </td>
            <td>
                <textarea cols="30" rows="6" id="opisVN" autofocus>

                </textarea>
                <!--Ubaci iz baze biografiju-->
            </td>
            <td>
                <input type="button" id="izmeniOpV" value="Promeni opis">
                <p id="greskaIzmene" class="poruka"></p>
            </td>
        </tr>

        <tr>

            <td>
                <label for="noviNaziv">Novi naziv vežbe:</label>
            </td>
            <td>
                <input type="text" id="noviNaziv">
                <p id="greskaNaziv" class="poruka"></p>
            </td>
            <td>
                <input type="button" id="izmeniNaz" value="Promeni Naziv">
            </td>

        </tr>
        <tr>
            <td>
                <label for="noviDatum">Novi datum održavanja:</label>

            </td>
            <td colspan="2">
                <input type="text" placeholder="gggg/mm/dd" id="noviDatum">
                <input type="button" value="Izmeni datum" id="izmeniDat">
                <p id="greskaDate"></p>
            </td>


        </tr>

        <tr>
            <td>
                <label for="novoVreme">Novi termin održavanja:</label>
            </td>
            <td colspan="2">
                <input type="text" id="novoVreme" placeholder="HH::mm:ss">
                <input type="button" value="Izmeni vreme" id="izmeniVr">
                <p id="greskaTime"></p>
            </td>
        </tr>

    </table>


</form>