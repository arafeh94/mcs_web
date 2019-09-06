<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 7/30/2019
 * Time: 1:12 PM
 */
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Mobile Crowd Sensing</title>
</head>

<div style="width: 100%;text-align: right;height: 64px">
    <?php if (isset($_SESSION['uid'])): ?>
        <button style="margin: 12px" class="btn btn-danger" onclick="window.location='index.php?r=logout'">
            LogOut
        </button>
    <?php endif; ?>
</div>

