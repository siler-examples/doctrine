<?php declare(strict_types=1);

namespace App;

use Doctrine\ORM\EntityManager;
use Siler\{Http\Request, Http\Response, Route};
use function Siler\array_get_int;
use function Siler\Functional\puts;

/** @var EntityManager $entity_manager */
$entity_manager = require_once __DIR__ . '/../bootstrap.php';

Route\get('/', puts('Hello, World!'));
Route\get('/todos', fn() => Response\json($entity_manager->getRepository(Todo::class)->findAll()));

Route\post('/todos', function () use ($entity_manager): void {
    $data = Request\json();
    $todo = Todo::fromArray($data);

    $entity_manager->persist($todo);
    $entity_manager->flush();

    Response\json($todo, 201);
});

Route\put('/todos/{id}', function (array $route_params) use ($entity_manager): void {
    $id = array_get_int($route_params, 'id');
    $data = Request\json();

    /** @var Todo $todo */
    $todo = $entity_manager->find(Todo::class, $id);

    if ($todo === null) {
        Response\not_found();
        return;
    }

    $todo->patch($data);

    $entity_manager->persist($todo);
    $entity_manager->flush();

    Response\json($todo);
});

Route\delete('/todos/{id}', function (array $route_params) use ($entity_manager): void {
    $id = array_get_int($route_params, 'id');
    $todo = $entity_manager->find(Todo::class, $id);

    if ($todo === null) {
        Response\not_found();
        return;
    }

    $entity_manager->remove($todo);
    $entity_manager->flush();

    Response\no_content();
});