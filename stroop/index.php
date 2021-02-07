<?php
    require_once 'stroopEffect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stroop effect</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="stroop-effect">
            <?php
                showStroopEffect();
            ?>
        </div>  
    </div>
</body>
</html>
