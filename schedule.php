<?php

require_once './browsing/Model.php';
require_once './browsing/Schedule.php';
require_once './browsing/Pagination.php';
require_once './db.php';


$searchParams = '';
$limit = 10;
$currentPage = 1;

$stmt = $pdo->prepare("SELECT COUNT(`flightschedule`.`flightno`) AS `flights_count` FROM `flightschedule`");
$stmt->execute();
$flightsCount = $stmt->fetchAll();

$flightsCount = $flightsCount[0]['flights_count'] ?? $limit;
$maxPage = ceil($flightsCount / $limit);

if (isset($_GET['filter']) && isset($_GET['city'])) {

    $filter = trim($_GET['filter']);
    $city = trim($_GET['city']);

    if (
        preg_match_all("/[A-Za-z -]+/", $city)
        &&
        in_array($filter, ['from', 'to'])
    ) {
        $searchParams = "WHERE `airport_" . $filter . "`.`city` = '" . $city . "'";
    }

}

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = intval(trim($_GET['page']));
}

$sql = "
    SELECT
        `flightschedule`.`flightno`,
        `flightschedule`.`monday`,
        `flightschedule`.`tuesday`,
        `flightschedule`.`wednesday`,
        `flightschedule`.`thursday`,
        `flightschedule`.`friday`,
        `flightschedule`.`saturday`,
        `flightschedule`.`sunday`,
        `airport_from`.`city` AS `city_from`,
        `airport_from`.`country` AS `country_from`,
        `airport_to`.`city` AS `city_to`,
        `airport_to`.`country` AS `country_to`
    FROM
        `flightschedule`
    INNER JOIN `airport_geo` AS `airport_from`
    ON
        `flightschedule`.`from` = `airport_from`.`airport_id`
    INNER JOIN `airport_geo` AS `airport_to`
    ON
        `flightschedule`.`to` = `airport_to`.`airport_id`
        " . $searchParams . "
    LIMIT :offset, :limit
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':offset' => $limit * ($currentPage - 1),
    ':limit' => $limit,
]);
$flights = $stmt->fetchAll();

$schedule = new Schedule();
$schedule->render([
    'flights' => $flights,
    'pagination' => new Pagination($currentPage, count($flights), $limit),
]);
