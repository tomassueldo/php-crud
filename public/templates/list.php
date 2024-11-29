<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Registros</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<h1>Lista de Registros</h1>
<table id="recordsTable">
    <thead>
    <tr>
        <th>ID</th> <!-- Añadido -->
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Documento</th>
        <th>Código de Área</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($records as $record): ?>
        <tr data-id="<?= htmlspecialchars($record['id']) ?>"> <!-- Añadido -->
            <td><?= htmlspecialchars($record['id']) ?></td> <!-- Añadido -->
            <td><?= htmlspecialchars($record['nombre']) ?></td>
            <td><?= htmlspecialchars($record['apellido']) ?></td>
            <td><?= htmlspecialchars($record['documento']) ?></td>
            <td><?= htmlspecialchars($record['area']) ?></td>
            <td><?= htmlspecialchars($record['telefono']) ?></td>
            <td><?= htmlspecialchars($record['email']) ?></td>
            <td>
                <button class="edit-btn" data-id="<?= $record['id'] ?>">Editar</button>
                <button class="delete-btn" data-id="<?= $record['id'] ?>">Borrar</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<!-- Modal para editar -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Editar Registro</h3>
        <form id="editForm">
            <input type="hidden" name="id"> <!-- Campo oculto para el ID -->
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
            <label>Apellido:</label>
            <input type="text" name="apellido" required>
            <label>Documento:</label>
            <input type="text" name="documento" maxlength="10" required>
            <label>Código de Área:</label>
            <input type="text" name="area" maxlength="3" required>
            <label>Teléfono:</label>
            <input type="text" name="telefono" minlength="8" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <button type="submit" class="update-btn">Actualizar</button>
        </form>
    </div>
</div>

<!-- Modal para confirmar eliminación -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <h3>¿Estás seguro de que deseas eliminar este registro?</h3>
        <div>
            <button id="confirmDelete" class="confirmDelete">Eliminar</button>
            <button id="cancelDelete" class="cancelDelete">Cancelar</button>
        </div>
    </div>
</div>

<script src="/js/list.js"></script>
</body>
</html>
