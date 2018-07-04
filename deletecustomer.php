<?php
$no_mail = "";
$mail = "";
$check = "";
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    
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
        
        if(!empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $mail = $_POST['mail'];
        
        require ("dbconn.php");
        
        function Secure($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $u_mail = Secure($_POST['mail']);
        
        $u_mail = mysqli_real_escape_string($conn, $u_mail);
        
        $sql = "DELETE FROM customers WHERE email = '$mail'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Er is iets misgegaan";
        }
        else {
            $check = "<div class='alert alert-info' role='alert'>Gegevens verwijderd</div>";
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
                width: 170px;
            }
        </style>
    </head>
    <body>
        <a class="btn btn-primary" href="addcustomer.php">Gebruikers toevoegen? Klik hier</a>
        <div class="container">
        <form method="POST" action="deletecustomer.php">
            
            <div class="form-group">
            <b><span class="left">Voer hier het e-mailadres in dat u wenst te verwijderen:</span></b>
            <input class="form-control" type="text" name="mail"/>
            <span><i><?php echo $no_mail;?></i></span><br>
            </div>
            
            <span class="left"></span>
            <input class="btn btn-danger" type="submit" name="submit" name="submit" value="Verwijder"/>
        </form>
        </div>
        <?php
        echo $check;
        ?>
    </body>
</html>