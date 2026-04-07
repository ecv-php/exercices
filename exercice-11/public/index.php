<?php
// public/index.php — Front Controller
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

use App\Controller\MovieController;

$pdo = getConnection();
$controller = new MovieController($pdo);

$page = $_GET['page'] ?? 'movies';
$action = $_GET['action'] ?? 'list';

match ($page . '/' . $action) {
    'movies/list'   => $controller->list(),
    'movies/show'   => $controller->show((int) ($_GET['id'] ?? 0)),
    'movies/create' => $controller->create(),
    'movies/delete' => $controller->delete((int) ($_GET['id'] ?? 0)),
    default         => http_response_code(404) && print('Page non trouvée'),
};
