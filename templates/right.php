<div class="col-3" id="desni"><!--Desni deo, sa login poljem-->


        <form  action="login.php" method="post"  id="toggle_action" name="login" onsubmit="return check()">
        <table id="log">
            <tr>
                <td>
                    <label for="username">Korisničko ime*</label>
                </td>
                <td>
                    <input type="text" id="username" name="usr" >
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Lozinka*</label>
                </td>
                <td>
                    <input type="password"  id="password" name="psd">
                </td>
            </tr>
            <tr>
                <td colspan="2" >
                    <p id="errorlog">

                    </p>
                </td>
            </tr>
            <tr>

                <td>
                    <input type="button" value="Otkaži" onclick="sakrij()">
                </td>
                <td>

                    <input type="submit" id="loginf" value="Prijavi se">
                </td>
            </tr>
        </table>


    </form>


</div>

</div>