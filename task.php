<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 7/30/2019
 * Time: 1:00 PM
 */
include "tools.php";
include "chaincode/chaincode.php";
$title = post('title');
$budget = post('budget');
$expDt = post('expDt');
$minQ = post('minQ');
$uid = session('uid');
$type = session('type');
$msg = null;
$msgType = 'danger';
if (post('i')) {
    if ($budget && $title && $minQ && $expDt) {
        createTask($uid, $minQ, $budget, $expDt);
        $msg = 'Task Created';
        $msgType = 'info';
    } else {
        $msg = "Missing Fields";
    }
}
$tasks = getTasks($uid);
?>

<?php if (!empty($tasks)): ?>
    <h1 style="display: table;margin: auto">Tasks</h1>
    <table class="table table-striped table-bordered table-hover" style="width: 80%;margin: auto auto 50px;">
        <thead class="">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Minimum Quality</th>
            <th>Budget</th>
            <th>Status</th>
            <th>Report</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= $task['id'] ?></td>
                <td><?= $task['title'] ?></td>
                <td><?= $task['minQ'] ?></td>
                <td><?= $task['budget'] ?></td>
                <td><?= $task['status'] ?></td>
                <td>
                    <form style="margin: 0" action="index.php?r=report" method="post">
                        <input type="hidden" name="tid" value="<?= $task['id'] ?>">
                        <button type="submit" class="btn btn-sm  btn-lg">View</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<form method="post" style="display: table;margin: auto">
    <h2>Create New Task</h2>
    <?php if ($msg): ?>
        <?php alert($msg, "alert-$msgType", ''); ?>
    <?php endif; ?>
    <div style="width: 320px">
        <input type="hidden" name="i" value="1">
        <table>
            <tr>
                <td>
                    <label for="title">Title</label>
                </td>
                <td>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="budget">Budget</label>
                </td>
                <td>
                    <input type="text" name="budget" class="form-control" placeholder="Budget">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="expDt">Expiry Date</label>
                </td>
                <td>
                    <input type="date" name="expDt" class="form-control" placeholder="Expiry Date">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="minQ">Min. Quality </label>
                </td>
                <td>
                    <select id="minQ" name="minQ" class="form-control" style="width: 250px">
                        <option>S</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                    </select>
                </td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary" style="width: 100%">Create</button>
    </div>

</form>
