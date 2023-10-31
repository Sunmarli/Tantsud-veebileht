<?php
if (isset($_GET['code'])) {die(highlight_file(__File__, 1)); }
require_once("conf.php");
global $yhendus;
include 'logout.php';
$kask_select=$yhendus->prepare(
    "SELECT paariID,hinne1, hinne2 FROM tantsupaarid WHERE hinne3=0  and hinne2!=0;");
$kask_select->bind_result($paariID,$hinne1,$hinne2);
$kask_select->execute();

if (isset($_POST['submit'])) {
    $selectedValue = $_POST['selected_value'];
    $selected_id = $_POST['selected_id'];
    $kask_select->close();

    $kask_update = $yhendus->prepare("UPDATE tantsupaarid SET hinne3 = ? WHERE paariID = ?");
    $kask_update->bind_param("ii", $selectedValue, $selected_id);
    $kask_update->execute();
    $kask_update->close();
    $yhendus->close();
    header("Location: tulemused.php");
    exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Hindamine</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">

    <div style="background-color: white;">

</head>
<nav>


    <div class="container">
        <div class="column">
            <a href="tulemused.php">Tulemuste Tabel</a>
            <a href="tyhi_hinne_leht2.php">Tagasi</a>
        </div>
        <div class="column">
            <div class="user-info">
                <?=$_SESSION['kasutaja']?> on logitud
                <form action="" method="post">
                    <input type="submit" name="logout" value="Logi välja" class="logout-button">
                </form>
            </div>
        </div>
    </div>
</nav>
<body>
<div class="w3-row">

    <div class="w3-twothird w3-container ">
<h1>Hindamine</h1>
<table class="w3-table  w3-centered  w3-card-4">
    <tr>
        <th>Paari ID</th>
        <th>Hinnne 1</th>

        <th>Hinnne 2</th>
        <th>Hinnne 3</th>
    </tr>
    <?php
    global  $yhendus;

    while($kask_select->fetch()){
        echo "<tr>";
        echo "<td>".$paariID."</td>";
        echo "<td>".$hinne1."</td>";
        echo "<td>".$hinne2."</td>";
        echo "<td>
                     <form action='' method='post'>
                    <select name='selected_value' id='selected_id'>
                    <option value='1'>1</option> 
                    <option value='2'> 2</option>
                    <option value='3'>3</option>
                    <option value='4'> 4</option>
                    <option value='5'>5</option>
                    </select>
                    <input type='hidden' name='selected_id' value='" . $paariID . "'>
                    <input type='submit' name='submit' value='Submit'>
                    </form>
                    </td>";


    }
    ?>

</table>
</body>
</html>
