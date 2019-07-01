<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php'; // importamos nuestro gestor de bd para usarlo

$app = new \Slim\app;

// crear las rutas de las tablas
require '../src/rutas/eventos.php';
require '../src/rutas/usuarios.php';
require '../src/rutas/emociones.php';
require '../src/rutas/lugares.php';
require '../src/rutas/cuestionarios.php';

$app->run();