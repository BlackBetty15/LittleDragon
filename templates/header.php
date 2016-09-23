
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <link  rel="stylesheet" type="text/css" href="./css/style.css"> <!-- Putanja se gleda u odnosu na fajl u kom je pozvan-->
    <link rel="stylesheet" type="text/css" href="./css/grid.css">
    <title><?php echo $page_title ?></title>  <!--Ispisivanje naslova stranice-->
    <script type="text/javascript" src="js/script.js"></script>




</head>
<body>

<div class="row" id="baner"> <!--Baner, naslov stranice-->
    <div class="col-6">
        <header >
            <h1>Raspored vežbi</h1> <!--Naslov -->
        </header>
    </div>

    <div class="col-6">
        <nav>   <!-- Navigacija-->
            <ul>
                <li><?php echo $status ?></li> <!-- Status da li je korisnik ulogovan ili ne-->
                <li id="prijava">
                    <?php echo $name ?>
                </li> <!-- Ako je ulogovan, prikazuje ime, ako nije, pokazuje opciju za prijavljivanje-->
            </ul>

        </nav>
    </div>

</div>
<!--Ne zatvara se body tag jer će biti zatvoren u nekom od php fajlova ili footer tamplate-u -->





