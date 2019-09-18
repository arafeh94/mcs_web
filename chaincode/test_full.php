<div style="background-color: black;margin: 0">
    <?php
    /**
     * Created by PhpStorm.
     * User: Arafeh
     * Date: 8/1/2019
     * Time: 8:45 AM
     */

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include "chaincode.php";
    include "../tools.php";

    new_line("************add customer*************");
    new_line(addUser("arafeh", "arafeh198@gmail.com", "asd", "c"));
    new_line("***************get customer************");
    $arafeh = getUser("arafeh", "asd");
    new_line($arafeh);
    new_line();

    new_line("**********add participant************");
    new_line(addUser("hammoud", "hammmoud@gmail.com", "asd", "p"));
    new_line("**************get participant**********");
    $hammoud = getUser("hammoud", "asd");
    new_line($hammoud);
    new_line();

    new_line("**********add participant 2 ************");
    new_line(addUser("ajaj", "ajaj@gmail.com", "asd", "p"));
    new_line("**************get participant**********");
    $ajaj = getUser("ajaj", "asd");
    new_line($ajaj);
    new_line();

    new_line("************create task************");
    new_line(createTask($arafeh->id, 'task 1', 8, 1000, "2019-08-01 12:00:00"));
    new_line("************get all arafeh tasks");
    new_line(getTasks($arafeh->id));

    new_line("***********get all available tasks************");
    $avTasks = getAvailableTasks($hammoud->id);
    new_line($avTasks);
    new_line("***********subscribe ahmad to a task************");
    $avTasks = getAvailableTasks($hammoud->id);
    new_line(subscribe($avTasks[0]->id, $hammoud->id));
    new_line("***********subscribe ajaj to a task************");
    new_line(subscribe($avTasks[0]->id, $ajaj->id));
    new_line("***********get ahmad all subscribed task************");
    new_line(getSubscribedTask($hammoud->id));
    new_line("***********get ajaj all subscribed task************");
    new_line(getSubscribedTask($ajaj->id));
    new_line();

    new_line("*********add observations {ahmad}**********");
    new_line(addObservation($hammoud->id, $avTasks[0]->id, "2019-10-10 12:00:00", ['lat' => 10, 'lng' => 10, 'activity' => 4]));
    new_line(addObservation($hammoud->id, $avTasks[0]->id, "2019-10-10 12:00:01", ['lat' => 10, 'lng' => 11, 'activity' => 4]));
    new_line(addObservation($hammoud->id, $avTasks[0]->id, "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
    new_line(addObservation($hammoud->id, $avTasks[0]->id, "2019-10-10 12:00:03", ['lat' => 10, 'lng' => 13, 'activity' => 1]));
    new_line(addObservation($hammoud->id, $avTasks[0]->id, "2019-10-10 12:00:04", ['lat' => 10, 'lng' => 14, 'activity' => 2]));
    new_line(addObservation($hammoud->id, $avTasks[0]->id, "2019-10-10 12:00:05", ['lat' => 10, 'lng' => 15, 'activity' => 2]));

    new_line("*********add observations {ajaj}**********");
    new_line(addObservation($ajaj->id, $avTasks[0]->id, "2019-10-10 12:00:00", ['lat' => 10, 'lng' => 10, 'activity' => 4]));
    new_line(addObservation($ajaj->id, $avTasks[0]->id, "2019-10-10 12:00:01", ['lat' => 10, 'lng' => 11, 'activity' => 4]));
    new_line(addObservation($ajaj->id, $avTasks[0]->id, "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
    new_line(addObservation($ajaj->id, $avTasks[0]->id, "2019-10-10 12:00:03", ['lat' => 10, 'lng' => 13, 'activity' => 1]));
    new_line(addObservation($ajaj->id, $avTasks[0]->id, "2019-10-10 12:00:04", ['lat' => 10, 'lng' => 14, 'activity' => 2]));
    new_line(addObservation($ajaj->id, $avTasks[0]->id, "2019-10-10 12:00:05", ['lat' => 10, 'lng' => 15, 'activity' => 2]));


    new_line(quality($avTasks[0]->id));
    new_line(getReport($avTasks[0]->id));

    ?>
</div>
