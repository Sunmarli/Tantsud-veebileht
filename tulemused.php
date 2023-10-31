<?php
if (isset($_GET['code'])) {die(highlight_file(__File__, 1)); }
require_once("conf.php");
//include 'logout.php';
session_start();

if(isset($_POST['logout'])){
    session_destroy();
    header('Location: registreerimine.php');
    exit();
}
require("soring.php");
global $yhendus;

$kask = $yhendus->prepare("UPDATE tantsupaarid SET keskmine_hinne = (hinne1 + hinne2 + hinne3) / 3;");
$kask->execute();
$kask->close();

$kask = $yhendus->prepare("SELECT paariID, hinne1, hinne2, hinne3, keskmine_hinne FROM tantsupaarid;");
$kask->bind_result($paariID, $hinne1, $hinne2, $hinne3, $keskmine_hinne);
$kask->execute();
$kask->close();

$sorttulp = "paariID";
$otsisona = "";

if (isset($_REQUEST["sort"])) {
    $sorttulp = $_REQUEST["sort"];
}

if (isset($_REQUEST["otsisona"])) {
    $otsisona =  $_REQUEST["otsisona"];
}
$results = kysiAndmed($sorttulp, $otsisona);

if (isset($_SESSION['tuvastamine'])) {
    // User is logged in
   
    $loggedIn = true;
} else {
    // User is not logged in
    $loggedIn = false;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Tulemuste tabel</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">

    <div style="background-color: white;">

</head>
<nav>
<div class="container">
    <div class="column" >
        
        <a href="tyhi_hinne_leht.php">Pane Hinne 1</a>
    <a href="tyhi_hinne_leht2.php">Pane Hinne 2</a>
    <a href="tyhi_hinne_leht3.php">Pane hinne 3</a>
    </div>
    <div class="column">
         <?php if ($loggedIn) : ?>
            <div class="user-info">
                <?=$_SESSION['kasutaja']?> on logitud
                <form action="" method="post">
                    <input type="submit" name="logout" value="Logi välja" class="logout-button">
                </form>
            
            </div>
        <?php endif; ?>
    </div>
</div>
</nav>

</nav>
<body>
<form method="get" action="" id="otsing">
    <label for="otsisona">Search by Paari ID:</label>
    <input type="text" name="otsisona" id="otsisona" value="<?= $otsisona ?>" />
    <input type="submit" value="Search " />
</form>

<div class="w3-row">

    <div class="w3-twothird w3-container ">
        <h1>Tulemuste Tabel</h1>
    <table class="w3-table w3-striped w3-centered w3-hoverable w3-card-4">
    <tr class="w3-blue">

        <th><a href="?sort=paariID">Paari ID</a></th>
        <th>Hinne 1</th>
        <th>Hinne 2</th>
        <th>Hinne 3</th>
        <th><a href="?sort=keskmine_hinne">Keskmine</a></th>
    </tr>
    <?php
    global  $yhendus;
        foreach ($results as $result):?>
            <?php  echo "
        <tr>
            <td>{$result->paariID}</td>
            <td>{$result->hinne1}</td>
            <td>{$result->hinne2}</td>
            <td>{$result->hinne3}</td>
            <td>{$result->keskmine_hinne}</td>
        </tr>";
    ?>
        <?php endforeach; ?>
</table>
</body>
</html>
