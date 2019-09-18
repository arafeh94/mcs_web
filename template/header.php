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
        <div style="margin: 12px">
            <button class="btn btn-danger" onclick="window.location='index.php?r=logout'">
                LogOut
            </button>
            <input type="text" readonly class="btn btn-link" onclick="copy(this)" value="<?= $_SESSION['uid'] ?>" style="padding: 0;width: 150px"/>
        </div>
    <?php endif; ?>
</div>

<script>
    function copy(element) {
        console.log(element);
        element.select();
        element.setSelectionRange(0, 99999); /*For mobile devices*/
        document.execCommand("copy");
    }
</script>

