<?php declare(strict_types=1);

namespace App;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once __DIR__ . '/vendor/autoload.php';

$conn = ['driver' => 'pdo_sqlite', 'path' => __DIR__ . '/db.sqlite'];
$config = Setup::createAnnotationMetadataConfiguration([__DIR__ . '/src'], true, null, null, false);

return EntityManager::create($conn, $config);