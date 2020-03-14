<?php declare(strict_types=1);

namespace App;

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entity_manager = require_once __DIR__ . '/bootstrap.php';
return ConsoleRunner::createHelperSet($entity_manager);