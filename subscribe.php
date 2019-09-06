<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 7/30/2019
 * Time: 1:00 PM
 */
include "tools.php";
include "chaincode/chaincode.php";
$uid = session('uid');
$tid = post('tid');
if ($tid && $uid) {
    subscribe($tid, $uid);
}
$tasks = getAvailableTasks($uid);
$subTask = getSubscribedTask($uid);
?>


<?php if (!empty($subTask)): ?>
    <h1 style="display: table;margin: auto auto 8px;">Subscribed Tasks</h1>
    <table class="table table-striped table-bordered table-hover" style="width: 80%;margin: auto auto 50px;">
        <thead class="">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Charge</th>
            <th>Quality</th>
            <th>Payment</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($subTask as $task): ?>
            <tr>
                <td><?= $task->id ?></td>
                <td><?= $task->title ?></td>
                <td><?= charge($task->minQ) ?></td>
                <td><?= isset($task->quality) ? $task->quality : 0 ?></td>
                <td><?= isset($task->payment) ? $task->payment : 0 ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if (!empty($tasks)): ?>
    <h1 style="display: table;margin: auto auto 8px">Available Tasks</h1>
    <table class="table table-striped table-bordered table-hover" style="width: 80%;margin: auto auto 50px;">
        <thead class="">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Charge</th>
            <th>Subscribe</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= $task->id ?></td>
                <td><?= $task->title ?></td>
                <td><?= charge($task->minQ) ?></td>
                <td>
                    <form style="margin: 0" method="post">
                        <input type="hidden" name="tid" value="<?= $task->id ?>">
                        <button type="submit" class="btn btn-sm  btn-lg btn-info">Participate</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


