<?php
/**
 * ---------------------------------------------------------
 *  CLASE Database
 *  - Maneja la conexión a MySQL usando PDO
 *  - Activa errores y uso de excepciones
 *  - Se usa en TODOS los modelos del proyecto
 * ---------------------------------------------------------
 */

declare(strict_types=1);

class Database
{
    private string $host = "localhost";      // Servidor
    private string $dbname = "glowup";       // Nombre BD
    private string $username = "root";       // Usuario
    private string $password = "";           // Contraseña
    private ?PDO $conn = null;               // Conexión PDO

    /**
     * Método para conectar a MySQL
     * @return PDO|null
     */
    public function connect(): ?PDO
    {
        // Si ya está conectada, devolver conexión actual
        if ($this->conn !== null) {
            return $this->conn;
        }

        try {
            // Crear conexión PDO
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );

            // Activar modo de errores de PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Activar modo array asociativo por defecto
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $this->conn;

        } catch (PDOException $e) {

            // Mostrar error de conexión (solo en desarrollo)
            die("❌ Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
}
