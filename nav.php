<?php if (isset($_GET['code'])) {die(highlight_file(__File__, 1)); }?>


<div class="container">
    <div class="column">
        <a href="tulemused.php">Tulemuste Tabel</a>
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

