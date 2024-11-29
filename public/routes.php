<?php

use App\Controllers\FormularioController;

return [
    'GET /formulario' => [FormularioController::class, 'index'],
    'POST /formulario' => [FormularioController::class, 'store'],
    'GET /formulario/list' => [FormularioController::class, 'list'],
    'PUT /formulario' => [FormularioController::class, 'update'],
    'DELETE /formulario' => [FormularioController::class, 'delete'],
];
