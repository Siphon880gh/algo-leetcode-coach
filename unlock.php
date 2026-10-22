<?php
/**
 * Unlock / lock hidden premium pages (see includes/premium.php).
 * GET shows a password form (or a Lock button when unlocked); POST checks
 * PREMIUM_PASSWORD from .env with hash_equals. Errors stay generic.
 */
declare(strict_types=1);

require_once __DIR__ . '/includes/layout.php';

const UNLOCK_IP_WINDOW = 900;   // seconds
const UNLOCK_IP_MAX_FAILS = 10; // per IP per window
const UNLOCK_FREE_FAILS = 3;    // per session before delays start

header('X-Robots-Tag: noindex, nofollow');
header('Cache-Control: no-store');

premium_session_start(true);
if (!is_string($_SESSION['csrf'] ?? null) || $_SESSION['csrf'] === '') {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

$back = premium_safe_back((string) ($_POST['back'] ?? $_GET['back'] ?? ''));
$error = '';
$status = 200;

function unlock_ip_path(): string
{
    $ip = (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
    return rtrim(sys_get_temp_dir(), '/') . '/lcc-unlock-' . hash('sha256', $ip) . '.json';
}

/** @return array{n: int, t: int} */
function unlock_ip_read(): array
{
    $raw = @file_get_contents(unlock_ip_path());
    $d = is_string($raw) ? json_decode($raw, true) : null;
    $rec = ['n' => (int) ($d['n'] ?? 0), 't' => (int) ($d['t'] ?? 0)];
    if ($rec['t'] < time() - UNLOCK_IP_WINDOW) {
        $rec = ['n' => 0, 't' => time()];
    }
    return $rec;
}

function unlock_ip_fail(): void
{
    $rec = unlock_ip_read();
    $rec['n']++;
    @file_put_contents(unlock_ip_path(), json_encode($rec), LOCK_EX);
}

function unlock_ip_clear(): void
{
    @unlink(unlock_ip_path());
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $action = (string) ($_POST['action'] ?? '');
    $csrf = (string) ($_POST['csrf'] ?? '');
    if ($csrf === '' || !hash_equals($_SESSION['csrf'], $csrf)) {
        $error = 'That did not work. Please try again.';
        $status = 400;
    } elseif ($action === 'lock') {
        unset($_SESSION['premium_unlocked'], $_SESSION['premium_fp']);
        session_regenerate_id(true);
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        session_write_close();
        header('Location: ' . $back, true, 303);
        exit;
    } elseif ($action === 'unlock') {
        $now = time();
        $until = (int) ($_SESSION['unlock_until'] ?? 0);
        if ($until > $now || unlock_ip_read()['n'] >= UNLOCK_IP_MAX_FAILS) {
            $error = 'Too many attempts. Try again later.';
            $status = 429;
        } else {
            usleep(random_int(300000, 600000));
            $expected = premium_password();
            $given = (string) ($_POST['password'] ?? '');
            $ok = $expected !== '' && $given !== ''
                && hash_equals(hash('sha256', $expected), hash('sha256', $given));
            if ($ok) {
                session_regenerate_id(true);
                $_SESSION['premium_unlocked'] = true;
                $_SESSION['premium_fp'] = premium_fingerprint();
                $_SESSION['csrf'] = bin2hex(random_bytes(32));
                unset($_SESSION['unlock_fails'], $_SESSION['unlock_until']);
                unlock_ip_clear();
                session_write_close();
                header('Location: ' . $back, true, 303);
                exit;
            }
            $fails = (int) ($_SESSION['unlock_fails'] ?? 0) + 1;
            $_SESSION['unlock_fails'] = $fails;
            if ($fails >= UNLOCK_FREE_FAILS) {
                $_SESSION['unlock_until'] = $now + min(900, 5 * (2 ** ($fails - UNLOCK_FREE_FAILS)));
            }
            unlock_ip_fail();
            $error = 'That did not work. Please try again.';
            $status = 401;
        }
    } else {
        $error = 'That did not work. Please try again.';
        $status = 400;
    }
}

$csrfToken = $_SESSION['csrf'];
session_write_close();
premium_state_reset();
$unlocked = premium_unlocked();

http_response_code($status);
layout_start(['title' => $unlocked ? 'Lock' : 'Unlock']);
?>
<div class="page-head">
    <h1><?= $unlocked ? 'Unlocked' : 'Unlock' ?></h1>
</div>
<?php if ($error !== ''): ?>
<p class="unlock-error" role="alert"><?= e($error) ?></p>
<?php endif; ?>
<?php if ($unlocked): ?>
<form class="unlock-form" method="post" action="<?= e(url('unlock.php')) ?>">
    <input type="hidden" name="action" value="lock">
    <input type="hidden" name="csrf" value="<?= e($csrfToken) ?>">
    <input type="hidden" name="back" value="<?= e($back) ?>">
    <button type="submit" class="btn btn--small btn--ghost">Lock</button>
</form>
<?php else: ?>
<form class="unlock-form" method="post" action="<?= e(url('unlock.php')) ?>" autocomplete="off">
    <input type="hidden" name="action" value="unlock">
    <input type="hidden" name="csrf" value="<?= e($csrfToken) ?>">
    <input type="hidden" name="back" value="<?= e($back) ?>">
    <label class="visually-hidden" for="unlock-password">Password</label>
    <input id="unlock-password" type="password" name="password" placeholder="Password" required autofocus>
    <button type="submit" class="btn btn--small btn--primary">Unlock</button>
</form>
<?php endif; ?>
<a class="back-link" href="<?= e($back) ?>">← Back</a>
<?php
layout_end();
