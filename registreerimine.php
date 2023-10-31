<?php
if (isset($_GET['code'])) {die(highlight_file(__File__, 1)); }
require_once("conf.php");
if (isset($_POST["sisestusnupp"])) {
    global $yhendus;
    $kask = $yhendus->prepare("INSERT INTO tantsupaarid VALUES ()");
    $kask->execute();
    $lastInsertId = $yhendus->insert_id;

    $yhendus->close();
    // Show an alert message with the last inserted ID
    echo "<script>
            alert('Olete registreerinud. Teie paariID: " . $lastInsertId . "');
            window.location.href = 'tulemused.php';
          </script>";
    exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Registreerimine</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">
  
</head>
<nav>
<div class="container">
    <div class="column" >
        <a href="login.php" >Log in </a>
        <a href="tulemused.php" >Tulemuste tabel </a>
        <a href="Kirjalik_osa_PHP_projekt.pdf" target="_blank">Download PDF</a> 
    </div>
    <div class="column">

    </div>
</div>
</nav>
<body>
<h1>Registreerimine Hambotantsuvõistlusele</h1>

<form method="post" action="" class="w3-container" >
    <label for="sisestusnupp">Paari Registreerimine:</label>
    <input type="submit" name="sisestusnupp" value="Registreeri" />
</form>
<div id="dance_image">
    <img src="images/dance.PNG" alt="Dance Image" height="250px";>
</div>

</body>
</html>
