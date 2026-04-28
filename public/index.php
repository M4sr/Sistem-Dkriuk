<?php

if (!session_id()) session_start();

require_once '../config/config.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';
require_once '../app/core/Flasher.php';
require_once '../app/core/Pagination.php';

$app = new App;
