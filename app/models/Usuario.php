<?php
/**
 * Modelo Usuario
 * Se encarga de todas las consultas a la tabla usuarios.
 * Funciones:
 *  - registrar usuario
 *  - obtener usuario por email
 */

class Usuario {

    private $db;

    public function __construct() {
        // Conexión con la base de datos
        $this->db = Database::conectar();
    }

    /**
     * Registrar un nuevo usuario
     */
    public function registrar($nombre, $email, $password) {
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $email, $password]);
    }

    /**
     * Obtener un usuario por el email
     */
    public function obtenerPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
