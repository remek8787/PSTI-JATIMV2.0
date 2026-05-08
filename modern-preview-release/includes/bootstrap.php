<?php

declare(strict_types=1);

session_start();
date_default_timezone_set('Asia/Jakarta');

const APP_NAME = 'PSTI Jawa Timur';
const BASE_PATH = __DIR__ . '/..';
const DATA_PATH = BASE_PATH . '/data';
const UPLOAD_PATH = BASE_PATH . '/uploads';

function base_url(string $path = ''): string
{
    $script = str_replace('\\\\', '/', (string)($_SERVER['SCRIPT_NAME'] ?? ''));
    $prefix = '';
    if (strpos($script, '/modern-preview/') === 0) {
        $prefix = '/modern-preview';
    }
    return $prefix . '/' . ltrim($path, '/');
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function path_join(string ...$parts): string
{
    return preg_replace('#/+#', '/', implode('/', $parts));
}

function json_read(string $name): array
{
    $file = DATA_PATH . '/' . $name . '.json';
    if (!is_file($file)) {
        return [];
    }
    $raw = file_get_contents($file);
    if ($raw === false || trim($raw) === '') {
        return [];
    }
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function json_write(string $name, array $data): void
{
    if (!is_dir(DATA_PATH)) {
        mkdir(DATA_PATH, 0775, true);
    }
    $file = DATA_PATH . '/' . $name . '.json';
    $tmp = $file . '.tmp';
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($json === false || file_put_contents($tmp, $json, LOCK_EX) === false) {
        throw new RuntimeException('Gagal menulis data sementara.');
    }
    if (!rename($tmp, $file)) {
        throw new RuntimeException('Gagal menyimpan data.');
    }
}

function current_user(): ?array
{
    return $_SESSION['admin_user'] ?? null;
}

function is_logged_in(): bool
{
    return current_user() !== null;
}

function require_login(): void
{
    if (!is_logged_in()) {
        header('Location: ' . base_url('admin/login.php'));
        exit;
    }
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function verify_csrf(): void
{
    $token = (string)($_POST['csrf_token'] ?? '');
    if ($token === '' || !hash_equals((string)($_SESSION['csrf_token'] ?? ''), $token)) {
        http_response_code(419);
        exit('CSRF token tidak valid.');
    }
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

function flashes(): array
{
    $items = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $items;
}

function slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/i', '-', $text) ?: '';
    $text = trim($text, '-');
    return $text !== '' ? $text : 'item-' . time();
}

function next_id(array $items): int
{
    $max = 0;
    foreach ($items as $item) {
        $max = max($max, (int)($item['id'] ?? 0));
    }
    return $max + 1;
}

function normalize_image(?string $path, string $fallback = '/assets/logo.png'): string
{
    $path = trim((string)$path);
    if ($path === '') {
        return $fallback;
    }
    if (preg_match('#^https?://#i', $path)) {
        return $path;
    }
    return base_url($path);
}

function upload_image(string $field, string $folder, ?string $old = null): ?string
{
    if (empty($_FILES[$field]) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    $file = $_FILES[$field];
    if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Upload gagal.');
    }
    if (($file['size'] ?? 0) > 3 * 1024 * 1024) {
        throw new RuntimeException('Ukuran gambar maksimal 3MB.');
    }
    $ext = strtolower(pathinfo((string)$file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
        throw new RuntimeException('Format gambar tidak didukung.');
    }
    $dir = UPLOAD_PATH . '/' . trim($folder, '/');
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
    $name = date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $dest = $dir . '/' . $name;
    if (!move_uploaded_file((string)$file['tmp_name'], $dest)) {
        throw new RuntimeException('Gagal menyimpan gambar.');
    }
    if ($old && !preg_match('#^https?://#i', $old)) {
        $oldFile = BASE_PATH . '/' . ltrim($old, '/');
        if (is_file($oldFile) && strpos(realpath($oldFile) ?: '', realpath(UPLOAD_PATH) ?: '') === 0) {
            @unlink($oldFile);
        }
    }
    return 'uploads/' . trim($folder, '/') . '/' . $name;
}

function sort_by_date_desc(array $items, string $field = 'published_at'): array
{
    usort($items, static function (array $a, array $b) use ($field): int {
        $ta = strtotime((string)($a[$field] ?? $a['created_at'] ?? '')) ?: 0;
        $tb = strtotime((string)($b[$field] ?? $b['created_at'] ?? '')) ?: 0;
        return $tb <=> $ta;
    });
    return $items;
}
