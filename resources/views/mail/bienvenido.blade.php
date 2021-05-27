<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Bievenida</title>
</head>
<body>
    <p>Bienvenido! {{ $user->empleado->nombre }}.</p>
    <p>Ahora eres parte del grupo de trabajo de "Papeleria la economica"</p>
    <ul>
        <li>Nombre: {{ $user->empleado->nombre }}</li>
        <li>Correo: {{ $user->email }}</li>
        <li>Contrasena: {{ $password }}</li>
    </ul>
</body>
</html>