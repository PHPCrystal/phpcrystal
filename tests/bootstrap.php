<?php
namespace PHPCrystal\PHPCrystalTest;

use PHPCrystal\PHPCrystal\Component\Filesystem\FileHelper;

require (__DIR__ . '/../vendor/autoload.php');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

FileHelper::addAlias('app', __DIR__);