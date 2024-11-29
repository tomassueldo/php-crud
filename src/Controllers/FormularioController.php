<?php

namespace App\Controllers;

use App\Helpers\ActionHelper;
use App\Helpers\ValidationHelper;
use PDO;

class FormularioController
{
    /**
     * @return void
     */
    public function index(): void
    {
        echo file_get_contents(__DIR__ . '/../../public/templates/form.html');
    }

    /**
     * @return void
     */
    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $validation = ValidationHelper::validate($data);
        if (!$validation['success']) {
            ActionHelper::jsonResponse(['error' => $validation['message']], 400);
        }

        // Verificar unicidad (documento, teléfono, email)
        $pdo = ActionHelper::getDatabaseConnection();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM formulario WHERE documento = ? OR telefono = ? OR email = ?");
        $stmt->execute([$data['documento'], $data['telefono'], $data['email']]);
        if ($stmt->fetchColumn() > 0) {
            ActionHelper::jsonResponse(['error' => 'Documento, Teléfono o Email ya existe'], 400);
        }

        $stmt = $pdo->prepare("INSERT INTO formulario (nombre, apellido, documento, area, telefono, email)
                           VALUES (:nombre, :apellido, :documento, :area, :telefono, :email)");
        $stmt->execute($data);

        ActionHelper::jsonResponse(['success' => true, 'message' => 'Registro creado']);
    }


    /**
     * @return void
     */
    public function list(): void
    {
        $pdo = ActionHelper::getDatabaseConnection();
        $stmt = $pdo->query("SELECT * FROM formulario");
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../../public/templates/list.php';
    }

    /**
     * Actualizar un registro por ID.
     *
     * @return void
     */
    public function update(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validar datos
        $validation = ValidationHelper::validate($data);
        if (!$validation['success']) {
            ActionHelper::jsonResponse(['error' => $validation['message']], 400);
        }

        $pdo = ActionHelper::getDatabaseConnection();
        $stmt = $pdo->prepare("UPDATE formulario SET nombre = :nombre, apellido = :apellido, area = :area, 
                           telefono = :telefono, email = :email WHERE id = :id");

        $stmt->execute([
            ':nombre' => $data['nombre'],
            ':apellido' => $data['apellido'],
            ':area' => $data['area'],
            ':telefono' => $data['telefono'],
            ':email' => $data['email'],
            ':id' => $data['id'], // id viene en el JSON
        ]);

        ActionHelper::jsonResponse(['success' => true, 'message' => 'Registro actualizado']);
    }


    /**
     * Eliminar un registro por ID.
     *
     * @return void
     */
    public function delete(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $pdo = ActionHelper::getDatabaseConnection();
        $stmt = $pdo->prepare("DELETE FROM formulario WHERE id = ?");
        $stmt->execute([$data['id']]);

        if ($stmt->rowCount() > 0) {
            ActionHelper::jsonResponse(['success' => true, 'message' => 'Registro eliminado']);
        } else {
            ActionHelper::jsonResponse(['error' => 'Registro no encontrado'], 404);
        }
    }


}
