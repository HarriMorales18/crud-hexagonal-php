<?php
/** @var UserResponse|UserModel|null $user */
/** @var array<int, string> $roleOptions */
/** @var array<int, string> $statusOptions */
/** @var array<string, string> $old */
/** @var array<string, string> $errors */
/** @var string $message */
$user = $user ?? null;
$roleOptions = isset($roleOptions) && is_array($roleOptions) ? $roleOptions : array();
$statusOptions = isset($statusOptions) && is_array($statusOptions) ? $statusOptions : array();
$old = isset($old) && is_array($old) ? $old : array();
$errors = isset($errors) && is_array($errors) ? $errors : array();
$message = isset($message) && is_string($message) ? $message : '';
?>
<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Editar usuario</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if ($user === null): ?>
    <div class="alert-error">No se encontró información del usuario.</div>
    <p><a class="btn" href="?route=users.index">Volver al listado</a></p>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
<?php return; ?>
<?php endif; ?>

<form method="POST" action="?route=users.update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($old['id'] ?? $user->getId(), ENT_QUOTES, 'UTF-8')
    ?>">

    <div class="form-group">
        <label for="name">Nombre</label><br>
        <input
        type="text"
        id="name"
        name="name"
        value="<?= htmlspecialchars($old['name'] ?? $user->getName(), ENT_QUOTES, 'UTF-8') ?>"
        >
        <?php if (!empty($errors['name'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="email">Correo</label><br>
        <input
        type="email"
        id="email"
        name="email"
        value="<?= htmlspecialchars($old['email'] ?? $user->getEmail(), ENT_QUOTES, 'UTF-8') ?>"
        >
        <?php if (!empty($errors['email'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="password">Contraseña <small>(déjala en blanco para no cambiarla)</small></label><br>
        <input
        type="password"
        id="password"
        name="password"
        value=""
        autocomplete="new-password"
        >
        <?php if (!empty($errors['password'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="role">Rol</label><br>
        <select id="role" name="role">
            <?php foreach ($roleOptions as $opt): ?>
                <option
                value="<?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?>"
                <?= (($old['role'] ?? $user->getRole()) === $opt) ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['role'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['role'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="status">Estado</label><br>
        <select id="status" name="status">
            <?php foreach ($statusOptions as $opt): ?>
                <option
                value="<?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?>"
                <?= (($old['status'] ?? $user->getStatus()) === $opt) ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['status'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['status'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
    &nbsp;
    <a class="btn" href="?route=users.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>