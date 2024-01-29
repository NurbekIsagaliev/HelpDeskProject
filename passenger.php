<?php

require_once './browsing/Model.php';
require_once './browsing/Passenger.php';
require_once './db.php';


if (!isset($_GET['id']) || !is_numeric(trim($_GET['id']))) {
echo('Введите пожалуйста в  пойсковой строке после passenger.php, id конкретного пассажира!  '.
     'Например ../passenger.php?id=6');
    die();
}

$passengerID = intval(trim($_GET['id']));

$sql = "
    SELECT
        COUNT(`booking`.`passenger_id`) AS `booking_count_from`,
        `airport_geo`.`country` AS `country_from`
    FROM
        `passenger`
    INNER JOIN `booking` ON `booking`.`passenger_id` = `passenger`.`passenger_id`
    INNER JOIN `flight` ON `flight`.`flight_id` = `booking`.`flight_id`
    INNER JOIN `airport_geo` ON `airport_geo`.`airport_id` = `flight`.`from`
    WHERE
        `passenger`.`passenger_id` = :passengerID
    GROUP BY
        `airport_geo`.`country`
";

$stmt = $pdo->prepare($sql);
$stmt->execute([':passengerID' => $passengerID]);

$countryFrom = $stmt->fetchAll();

$sql = "
    SELECT
        COUNT(`booking`.`passenger_id`) AS `booking_count_to`,
        `airport_geo`.`country` AS `country_to`
    FROM
        `passenger`
    INNER JOIN `booking` ON `booking`.`passenger_id` = `passenger`.`passenger_id`
    INNER JOIN `flight` ON `flight`.`flight_id` = `booking`.`flight_id`
    INNER JOIN `airport_geo` ON `airport_geo`.`airport_id` = `flight`.`to`
    WHERE
        `passenger`.`passenger_id` = :passengerID
    GROUP BY
        `airport_geo`.`country`
";

$stmt = $pdo->prepare($sql);
$stmt->execute([':passengerID' => $passengerID]);

$countryTo = $stmt->fetchAll();

$sql = "
    SELECT
        `passenger`.`firstname`,
        `passenger`.`lastname`,
        COUNT(`booking`.`passenger_id`) AS `booking_count`
    FROM
        `passenger`
    INNER JOIN `booking` ON `booking`.`passenger_id` = `passenger`.`passenger_id`
    WHERE
        `passenger`.`passenger_id` = :passengerID
    GROUP BY
        `passenger`.`passenger_id`
";

$stmt = $pdo->prepare($sql);
$stmt->execute([':passengerID' => $passengerID]);

$passenger = $stmt->fetchAll();
$passenger = $passenger[0];

$passengerClass = new Passenger();
$passengerClass->render([
    'countryTo' => $countryTo,
    'countryFrom' => $countryFrom,
    'passenger' => $passenger,
]);
