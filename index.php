<?php

require_once './browsing/Model.php';
require_once './db.php';

$home = new Model();
$home->render(null);
