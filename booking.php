<?php
require_once './browsing/Model.php';
require_once './browsing/Booking.php';
require_once './browsing/Pagination.php';
require_once './db.php';


$currentPage = 1;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = intval(trim($_GET['page']));
}

$sqlStr = "
    SELECT
        `passenger`.*,
        `airport_from`.`country` AS `country_from`,
        `airport_from`.`city` AS `city_from`,
        `airport_to`.`country` AS `country_to`,
        `airport_to`.`city` AS `city_to`
    FROM
        `booking`
    INNER JOIN
        `passenger`
        ON `booking`.`passenger_id` = `passenger`.`passenger_id`
    INNER JOIN
        `flight`
        ON `booking`.`flight_id` = `flight`.`flight_id`
    INNER JOIN
        `airport_geo` AS `airport_from`
        ON `flight`.`from` = `airport_from`.`airport_id`
    INNER JOIN
        `airport_geo` AS `airport_to`
        ON `flight`.`to` = `airport_to`.`airport_id`
    LIMIT :offset, 50
";

$stmt = $pdo->prepare($sqlStr);
$stmt->execute([
    ':offset' => 50 * ($currentPage - 1),
]);
$bookings = $stmt->fetchAll();

$stmt = $pdo->query("SELECT COUNT(*) AS `bookings_count` FROM `booking` LIMIT 1");
$res = $stmt->fetch();

$bookingPage = new Booking();
$bookingPage->render([
    'bookings' => $bookings,
    'pagination' => new Pagination($currentPage, $res['bookings_count'], 50),
]);
