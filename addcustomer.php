<?php
$no_vnaam = $no_anaam = $no_nummer = $no_mail = "";
$vnaam = $tvoegsel = $anaam = $nummer = $mail = "";
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    
    if (empty ($_POST['vnaam'])) {
        $no_vnaam = "Voornaam is een verplicht veld";
    }
    else {
        $vnaam = $_POST ['vnaam'];
    }
    
    $tvoegsel = $_POST ['tvoegsel'];
    
    if (empty ($_POST['anaam'])) {
        $no_anaam = "Achternaam is een verplicht veld";
    }
    else {
        $anaam = $_POST ['anaam'];
    }
    if (empty ($_POST['nummer'])) {
        $no_nummer = "Telefoonnummer is een verplicht veld";
    }
    else {
        $nummer = $_POST ['nummer'];
    }
    if (empty ($_POST['mail'])) {
        $no_mail = "E-mail is een verplicht veld";
    }
    else if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $no_mail = "Geen geldig emailformaat";
    }
    else {
        $mail = $_POST ['mail'];
    }
}
?>

<!doctype html>
<html>
    <head>
        <title>L. Meijles PHP Eindtoets</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            .btn-primary {
                margin: 18px;
            }
            .container {
                margin-top: 40px;
                width: 30%;
            }
            .alert-info {
                margin: 45px;
                width: 180px;
            }
        </style>
    </head>
    <body>
        <a class="btn btn-primary" href="deletecustomer.php">Gebruikers verwijderen? Klik hier</a>
        <div class="container">
        <form method="POST" action="addcustomer.php">
            
            <div class="form-group">
            <b><span class="left">Voornaam:*</span></b>
            <input class="form-control" type="text" name="vnaam" value="<?php echo $vnaam;?>"/>
            <span><i><?php echo $no_vnaam;?></i></span><br>
            </div>
            
            <div class="form-group">
            <b><span class="left">Tussenvoegsel:</span></b>
            <input class="form-control" type="text" name="tvoegsel" value="<?php echo $tvoegsel;?>"/><br>
            </div>
                
            <div class="form-group">
            <b><span class="left">Achternaam:*</span></b>
            <input class="form-control" type="text" name="anaam"  value="<?php echo $anaam;?>"/>
            <span><i><?php echo $no_anaam;?></i></span><br>
            </div>
                
            <div class="form-group">
            <b><span class="left">Telefoonnummer:*</span></b>
            <input class="form-control" type="text" name="nummer"  value="<?php echo $nummer;?>"/>
            <span><i><?php echo $no_nummer;?></i></span><br>
            </div>
                
            <div class="form-group">
            <b><span class="left">E-mail:*</span></b>
            <input class="form-control" type="text" name="mail"  value="<?php echo $mail;?>"/>
            <span><i><?php echo $no_mail;?></i></span><br>
            </div>
            
            <span class="left"></span>
            <input type="submit" class="btn btn-success" name="submit" name="submit" value="Registreren"/>
        </form>
        </div>
        <?php
        
        if(!empty($_POST['vnaam']) && !empty($_POST['anaam']) && !empty($_POST['nummer']) && !empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $vnaam = $_POST['vnaam'];
        $tvoegsel = $_POST['tvoegsel'];
        $anaam = $_POST['anaam'];
        $nummer = $_POST['nummer'];
        $mail = $_POST['mail'];
        
        require ("dbconn.php");
        
        function Secure($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $u_vnaam = Secure($_POST['vnaam']);
        $u_tvoegsel = Secure($_POST['tvoegsel']);
        $u_anaam = Secure($_POST['anaam']);
        $u_nummer = Secure($_POST['nummer']);
        $u_mail = Secure($_POST['mail']);
        
        $u_vnaam = mysqli_real_escape_string($conn, $u_vnaam);
        $u_tvoegsel = mysqli_real_escape_string($conn, $u_tvoegsel);
        $u_anaam = mysqli_real_escape_string($conn, $u_anaam);
        $u_nummer = mysqli_real_escape_string($conn, $u_nummer);
        $u_mail = mysqli_real_escape_string($conn, $u_mail);
        
        $sql = "INSERT INTO customers (vnaam, tussenv, anaam, telnr, email) VALUES ('{$vnaam}', '{$tvoegsel}', '{$anaam}', '{$nummer}', '{$mail}')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
        }
        else {
            echo "<div class='alert alert-info' role='alert'>Gegevens toegevoegd</div>";
        }
        }
        ?>
    </body>
</html>