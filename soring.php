<?php
if (isset($_GET['code'])) {die(highlight_file(__File__, 1)); }
require('conf.php');
global $yhendus;
function kysiAndmed($sorttulp = "keskmine_hinne", $otsisona = "")
{
    global $yhendus;

    $lubatudtulbad = array("paariID", "keskmine_hinne");

    if (!in_array($sorttulp, $lubatudtulbad)) {
        return "lubamatu tulp";
    }

    $otsisona = addslashes(stripslashes($otsisona)); // Add wildcards for partial matching

    $kask = $yhendus->prepare("SELECT paariID, hinne1, hinne2, hinne3, keskmine_hinne FROM tantsupaarid
        WHERE paariID LIKE ? AND (paariID LIKE ?)  ORDER BY $sorttulp DESC");

    // You need to bind the parameter twice for the wildcard
    $otsisona_with_wildcard = '%' . $otsisona . '%';
    $kask->bind_param("ss", $otsisona_with_wildcard, $otsisona_with_wildcard);

    $kask->bind_result($paariId, $hinne1, $hinne2, $hinne3, $keskmine_hinne);
    $kask->execute();



    $results = array();
    while ($kask->fetch()) {
        $result = new stdClass();
        $result->paariID = $paariId;
        $result->hinne1 = $hinne1;
        $result->hinne2 = $hinne2;
        $result->hinne3 = $hinne3;
        $result->keskmine_hinne = $keskmine_hinne;
        array_push($results, $result);
    }

    return $results;
}
?>

