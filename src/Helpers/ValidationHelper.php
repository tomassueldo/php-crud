<?php

namespace App\Helpers;

use PDO;
use App\Helpers\ActionHelper;

class ValidationHelper
{
    /**
     * @param $data
     * @return array
     */
    public static function validate($data)
    {
        // Validar nombre
        if (!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\'-]+$/', $data['nombre'])) {
            return ['success' => false, 'message' => 'Nombre inválido'];
        }

        // Validar apellido
        if (!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\'-]+$/', $data['apellido'])) {
            return ['success' => false, 'message' => 'Apellido inválido'];
        }

        // Validar documento
        if (!preg_match('/^\d{1,10}$/', $data['documento'])) {
            return ['success' => false, 'message' => 'Documento inválido'];
        }

        // Validar código de área (3 dígitos y existencia en la tabla)
        if (!preg_match('/^\d{3}$/', $data['area'])) {
            return ['success' => false, 'message' => 'Código de área inválido'];
        }
        $pdo = ActionHelper::getDatabaseConnection();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM area WHERE codigo_area = ?");
        $stmt->execute([$data['area']]);
        if ($stmt->fetchColumn() == 0) {
            return ['success' => false, 'message' => 'Código de área no existe'];
        }

        // Validar teléfono
        if (!preg_match('/^\d{8,10}$/', $data['telefono'])) {
            return ['success' => false, 'message' => 'Teléfono inválido. Debe tener entre 8 y 10 dígitos.'];
        }


        // Validar email
        if (!self::validateEmail($data['email'])) {
            return ['success' => false, 'message' => 'Correo electrónico inválido'];
        }

        return ['success' => true, 'message' => 'Validación exitosa'];
    }

    /**
     * @param $email
     * @return bool
     */
    private static function validateEmail($email)
    {
        $regexUsuario = '/^[a-zA-Z0-9._-]+$/';
        $regexDominio = '/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/';

        $parts = explode('@', $email);
        if (count($parts) != 2) return false;

        [$nombreUsuario, $dominio] = $parts;

        if (!preg_match($regexUsuario, $nombreUsuario)) return false;
        if (preg_match('/^\./', $nombreUsuario) || preg_match('/\.$/', $nombreUsuario)) return false;
        if (preg_match('/\.\./', $nombreUsuario)) return false;
        if (!preg_match($regexDominio, $dominio)) return false;

        return true;
    }
}