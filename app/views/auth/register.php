<!-- app/views/auth/register.php -->
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Registro - GlowUp</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="/glow-up-online/public/css/estilos.css">
  <script>
    function validarRegister() {
      const nombre = document.getElementById('nombre').value.trim();
      const email = document.getElementById('email').value.trim();
      const pass = document.getElementById('password').value;
      const pass2 = document.getElementById('password_confirm').value;

      if (nombre.length < 3) { alert('El nombre debe tener al menos 3 caracteres.'); return false; }
      if (!email || !email.includes('@')) { alert('Email no válido.'); return false; }
      if (pass.length < 6) { alert('La contraseña debe tener mínimo 6 caracteres.'); return false; }
      if (pass !== pass2) { alert('Las contraseñas no coinciden.'); return false; }
      return true;
    }
  </script>
</head>
<body>
  <h1>Registro</h1>

  <?php if (!empty($errors) && is_array($errors)): ?>
    <div style="color:red; font-weight:bold;">
      <?php foreach ($errors as $k => $v): ?>
        <div><?= htmlspecialchars($v) ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="?url=register" onsubmit="return validarRegister();">
    <label>Nombre</label><br>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label>Email</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label>Contraseña</label><br>
    <input type="password" id="password" name="password" required minlength="6"><br><br>

    <label>Confirmar Contraseña</label><br>
    <input type="password" id="password_confirm" name="password_confirm" required minlength="6"><br><br>

    <button type="submit">Registrarme</button>
  </form>

  <p>¿Ya tienes cuenta? <a href="?url=login">Ingresar</a></p>
</body>
</html>
