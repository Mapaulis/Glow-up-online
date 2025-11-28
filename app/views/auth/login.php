<!-- app/views/auth/login.php -->
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Iniciar sesión - GlowUp</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="/glow-up-online/public/css/estilos.css">
  <script>
    // Validaciones simples en frontend
    function validarLogin() {
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();
      if (!email || !email.includes('@')) {
        alert('Ingresa un email válido.');
        return false;
      }
      if (!password || password.length < 4) {
        alert('La contraseña debe tener al menos 4 caracteres.');
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <h1>Iniciar sesión</h1>

  <?php if (!empty($error)): ?>
    <div style="color:red; font-weight:bold;"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="?url=login" onsubmit="return validarLogin();">
    <label>Email</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label>Contraseña</label><br>
    <input type="password" id="password" name="password" required minlength="4"><br><br>

    <button type="submit">Entrar</button>
  </form>

  <p>¿No tienes cuenta? <a href="?url=register">Regístrate</a></p>
</body>
</html>
