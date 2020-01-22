<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config/database.php';

// includes all of the needed dao files
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/baseDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/dao/daoFactory.php';

// Business Logic
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/baseLogic.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/logic/palindromeLogic.php';

// utility functions
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config/util.php';

?>