<?php
/**
 * Controlador de Autenticación
 * Maneja el inicio de sesión y cierre de sesión
 * Autor: GlowUp - Proyecto Final
 */

class AuthController
{
    private $db;

    /**
     * Constructor: recibe la conexión a la base de datos
     */
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    /**
     * Mostrar formulario de login
     */
    public function login()
    {
        require_once 'app/views/auth/login.php';
    }

    /**
     * Procesar inicio de sesión
     */
    public function loginPost()
    {
        // Validaciones básicas
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $errores = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El correo no es válido.";
        }

        if (strlen($password) < 4) {
            $errores[] = "La contraseña debe tener al menos 4 caracteres.";
        }

        if (!empty($errores)) {
            $_SESSION['errores'] = $errores;
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        // Buscar usuario en BD
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $query->bindParam(':email', $email);
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            $_SESSION['errores'] = ["El usuario no existe."];
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        // Validar contraseña
        if (!password_verify($password, $usuario['password'])) {
            $_SESSION['errores'] = ["Contraseña incorrecta."];
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        // Crear sesión
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'email' => $usuario['email'],
            'rol' => $usuario['rol']
        ];

        // Redirección según rol
        if ($usuario['rol'] === 'admin') {
            header("Location: index.php?controller=admin/producto&action=index");
        } else {
            header("Location: index.php");
        }
        exit;
    }

    /**
     * Cerrar sesión
     */
    public function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}

