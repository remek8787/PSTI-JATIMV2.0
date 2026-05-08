<?php require_once __DIR__ . '/../includes/bootstrap.php';
if (is_logged_in()) { header('Location: ' . base_url('admin/')); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    foreach (json_read('users') as $user) {
        if (($user['username'] ?? '') === $username && password_verify($password, (string)($user['password_hash'] ?? ''))) {
            session_regenerate_id(true);
            $_SESSION['admin_user'] = ['id' => $user['id'] ?? 0, 'username' => $username, 'name' => $user['name'] ?? $username, 'role' => $user['role'] ?? 'editor'];
            header('Location: ' . base_url('admin/')); exit;
        }
    }
    $error = 'Username atau password salah.';
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login Admin — PSTI Jatim</title><link rel="stylesheet" href="<?= e(base_url('assets/css/admin.css?v=20260508')) ?>"></head><body class="login-page"><form class="login-card" method="post"><img class="logo" src="<?= e(base_url('assets/logo.png')) ?>" alt=""><h1>Admin PSTI Jatim</h1><p>Masuk untuk mengelola berita, agenda, dan galeri.</p><?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?><?= csrf_field() ?><div class="field"><label>Username</label><input name="username" required autocomplete="username"></div><br><div class="field"><label>Password</label><input name="password" type="password" required autocomplete="current-password"></div><br><button class="btn" type="submit" style="width:100%">Masuk</button></form></body></html>
