<?php
require_once __DIR__ . '/../config/Database.php';

class Producto {

    private $conn;
    private $table = "productos";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Obtener todos
    public function obtenerTodos() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear
    public function crear($data) {
        $sql = "INSERT INTO {$this->table} (nombre, descripcion, precio, stock) 
                VALUES (:nombre, :descripcion, :precio, :stock)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':descripcion' => $data['descripcion'],
            ':precio' => $data['precio'],
            ':stock' => $data['stock']
        ]);
    }

    // Obtener por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar
    public function actualizar($id, $data) {
        $sql = "UPDATE {$this->table} 
                SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':descripcion' => $data['descripcion'],
            ':precio' => $data['precio'],
            ':stock' => $data['stock'],
            ':id'   => $id
        ]);
    }

    // Eliminar
    public function eliminar($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
