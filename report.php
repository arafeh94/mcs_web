<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 7/30/2019
 * Time: 1:00 PM
 */
include "tools.php";
include "chaincode/chaincode.php";

$taskId = post('tid');

if ($taskId) {
    $report = getReport($taskId);
    $activity = [
        '1' => "idle/still",
        '2' => "train/metro/tram",
        '3' => "walk",
        '4' => "car/bus/motorbike",
        '5' => "bicycle",
        '6' => "run",
        '7' => "skateboard",
    ];
}

?>

<?php if ($taskId): ?>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>idle</th>
            <th>train</th>
            <th>walk</th>
            <th>car</th>
            <th>bicycle</th>
            <th>run</th>
            <th>skateboard</th>
        </tr>
        <tr>
            <?php foreach ($report->data as $d): ?>
                <td><?= $d ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
<?php else: ?>
    <p>Invalid TaskId </p>
<?php endif; ?>
