<?php
/** @var UserResponse|UserModel|null $user */
/** @var string $message */
$user = $user ?? null;
$message = isset($message) && is_string($message) ? $message : '';
?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle de usuario</h1>

<?php if (!empty($message)): ?>
<div class="alert-error">
    <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
</div>
<?php endif; ?>

<?php if ($user !== null): ?>
<table class="detail-table">
    <tr>
        <th>ID</th>
        <td><?= htmlspecialchars($user->getId(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Nombre</th>
        <td><?= htmlspecialchars($user->getName(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Correo</th>
        <td><?= htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Rol</th>
        <td><?= htmlspecialchars($user->getRole(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Estado</th>
        <td><?= htmlspecialchars($user->getStatus(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
</table>

<p style="margin-top: 16px;">
    <a class="btn btn-warning" href="?route=users.edit&amp;id=<?= urlencode($user->getId()) ?>">Editar</a>
    &nbsp;
    <a class="btn" href="?route=users.index">Volver al listado</a>
</p>
<?php else: ?>
<div class="alert-error">No se encontró información del usuario.</div>
<p style="margin-top: 16px;">
    <a class="btn" href="?route=users.index">Volver al listado</a>
</p>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>