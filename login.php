<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 7/30/2019
 * Time: 1:00 PM
 */
include "tools.php";
include "chaincode/chaincode.php";

$username = post("username");
$password = post("password");
$email = post("email");
$type = post("type");
$error = null;
if (post('i')) {
    if (get('signup')) {
        if ($username && $password && $type && $email) {
            if (!userExists($username)) {
                addUser($username, $email, $password, $type);
                $user = getUser($username, $password);
                login($user);
            } else {
                $error = "user already exists";
            }
        } else {
            $error = "some field are missing";
        }
    } else {
        if ($username && $password) {
            $user = getUser($username, $password);
            if ($user) {
                login($user);
            } else {
                $error = "invalid username or password";
            }
        } else {
            $error = "some field are missing";
        }
    }
}

function login($user){
    session('uid', $user->id);
    session('type', $user->type);
    if ($user->type == 'c') {
        header('Location: ' . url('task'));
    } else {
        header('Location: ' . url('subscribe'));
    }
}
?>

<div style="width: 100%;height: 100%">
    <div class="d-flex justify-content-center align-items-center">
        <form method="post">
            <?php $error ? alert($error) : null ?>
            <h1><?= get("signup") ? "Sign Up" : "Sign In" ?></h1>
            <input type="hidden" name="i" value="<?= post('i', '1') ?>">
            <div class="form-group">
                <label for="username">
                    Username:
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </label>
            </div>
            <?php if (get('signup')): ?>
                <div class="form-group">
                    <label for="email">
                        Email:
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </label>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="password">
                    Password:
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </label>
            </div>
            <?php if (get('signup')): ?>
                <div class="form-group">
                    <label for="confirm-password">
                        Confirm Password:
                        <input type="password" name="confirm-password" class="form-control"
                               placeholder="Confirm Password">
                    </label>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio-p" class="custom-control-input" name="type" value="p">
                        <label class="custom-control-label" for="radio-p">As Participant</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio-c" class="custom-control-input" name="type" value="c">
                        <label class="custom-control-label" for="radio-c">As Customer</label>
                    </div>
                </div>
            <?php endif; ?>
            <button type="submit"
                    onclick='return goto()'
                    class="btn btn-primary" style="width: 48%">
                <?= get('signup') ? "Sign In" : "Sign Up" ?>
            </button>
            <button type="submit" class="btn btn-primary" style="width: 48%">Submit</button>
        </form>
    </div>
</div>

<script>
    function goto() {
        window.location.href = "<?=url('login', get('signup') ? [] : ['signup' => '1'])?>";
        return false;
    }
</script>
