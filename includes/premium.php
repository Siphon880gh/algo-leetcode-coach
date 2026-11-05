<?php
/**
 * Hidden premium pages.
 *
 * A guide or Step-by-step session is premium when its LeetCode number is in
 * content/problems/premium.json. Premium pages are invisible to web visitors
 * until they unlock with PREMIUM_PASSWORD (read from .env, or the real
 * environment, which wins). list_content() and load_content() call
 * premium_item_hidden(), so listings, search, companion links, and direct URLs
 * all behave as if the page did not exist. The CLI (build and link scripts)
 * always sees everything.
 *
 * The unlock flag lives in a PHP session that is only started for visitors
 * who already carry the session cookie (set by unlock.php), so locked
 * visitors never get a cookie.
 */

declare(strict_types=1);

const PREMIUM_SESSION_NAME = 'lcc_sid';
const PREMIUM_TYPES = ['guides', 'coaching'];

/**
 * Value from .env (project root) or the process environment. Missing → ''.
 */
function premium_env(string $key): string
{
    static $file = null;
    if ($file === null) {
        $file = [];
        $path = dirname(__DIR__) . '/.env';
        $lines = is_file($path) ? file($path, FILE_IGNORE_NEW_LINES) : false;
        foreach ($lines ?: [] as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#') {
                continue;
            }
            if (strncmp($line, 'export ', 7) === 0) {
                $line = ltrim(substr($line, 7));
            }
            $eq = strpos($line, '=');
            if ($eq === false) {
                continue;
            }
            $name = trim(substr($line, 0, $eq));
            $value = trim(substr($line, $eq + 1));
            $len = strlen($value);
            if ($len >= 2 && ($value[0] === '"' || $value[0] === "'") && $value[$len - 1] === $value[0]) {
                $value = substr($value, 1, -1);
            } else {
                $hash = strpos($value, ' #');
                if ($hash !== false) {
                    $value = rtrim(substr($value, 0, $hash));
                }
            }
            if (preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $name) === 1) {
                $file[$name] = $value;
            }
        }
    }

    $env = getenv($key);
    if (is_string($env) && $env !== '') {
        return $env;
    }

    return $file[$key] ?? '';
}

function premium_password(): string
{
    return premium_env('PREMIUM_PASSWORD');
}

/** @return array<int, true> */
function premium_numbers(): array
{
    static $set = null;
    if ($set !== null) {
        return $set;
    }
    $set = [];
    $path = dirname(__DIR__) . '/content/problems/premium.json';
    if (is_file($path)) {
        $list = json_decode((string) file_get_contents($path), true);
        if (is_array($list)) {
            foreach ($list as $n) {
                if (is_int($n) && $n > 0) {
                    $set[$n] = true;
                }
            }
        }
    }

    return $set;
}

/**
 * True when a LeetCode number, or the guide/session slug, is premium.
 *
 * @param int|string $numOrSlug
 */
function is_premium($numOrSlug, string $type = 'guides'): bool
{
    if (is_int($numOrSlug)) {
        return isset(premium_numbers()[$numOrSlug]);
    }
    $slug = (string) $numOrSlug;
    if (preg_match('/^[1-9][0-9]*$/', $slug) === 1) {
        return isset(premium_numbers()[(int) $slug]);
    }
    if ($slug === '' || strpos($slug, '..') !== false || strpos($slug, '/') !== false) {
        return false;
    }
    $metaPath = dirname(__DIR__) . '/content/' . $type . '/' . $slug . '/meta.php';
    if (!is_file($metaPath)) {
        return false;
    }
    $meta = require $metaPath;

    return is_array($meta) && premium_meta_is_premium($meta);
}

/** @param array<string, mixed> $meta */
function premium_meta_is_premium(array $meta): bool
{
    $raw = $meta['leetcode'] ?? null;
    if (is_string($raw) && preg_match('/^[1-9][0-9]*$/', trim($raw)) === 1) {
        $raw = (int) trim($raw);
    }

    return is_int($raw) && isset(premium_numbers()[$raw]);
}

function premium_is_https(): bool
{
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (int) ($_SERVER['SERVER_PORT'] ?? 0) === 443;
}

/**
 * Start (or resume) the unlock session. With $create false, only resumes a
 * session the visitor already has a cookie for.
 */
function premium_session_start(bool $create): bool
{
    if (PHP_SAPI === 'cli') {
        return false;
    }
    if (session_status() === PHP_SESSION_ACTIVE) {
        return true;
    }
    $cookie = $_COOKIE[PREMIUM_SESSION_NAME] ?? '';
    if (!$create && (!is_string($cookie) || $cookie === '')) {
        return false;
    }
    if (headers_sent()) {
        return false;
    }
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.use_trans_sid', '0');
    session_name(PREMIUM_SESSION_NAME);
    $base = function_exists('base_path') ? base_path() : '';
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => $base . '/',
        'secure' => premium_is_https(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    return session_start();
}

/** Binds an unlocked session to the current password, so changing it locks everyone. */
function premium_fingerprint(): string
{
    $pw = premium_password();

    return $pw === '' ? '' : hash_hmac('sha256', 'lcc-premium-unlock', $pw);
}

/** @var array{unlocked: bool, csrf: string, notice: string}|null */
$GLOBALS['__premium_state'] = null;

/** @return array{unlocked: bool, csrf: string, notice: string} */
function premium_state(): array
{
    if (is_array($GLOBALS['__premium_state'] ?? null)) {
        return $GLOBALS['__premium_state'];
    }
    $state = ['unlocked' => false, 'csrf' => '', 'notice' => ''];
    if (premium_session_start(false)) {
        $fp = premium_fingerprint();
        $state['unlocked'] = $fp !== ''
            && !empty($_SESSION['premium_unlocked'])
            && is_string($_SESSION['premium_fp'] ?? null)
            && hash_equals($fp, $_SESSION['premium_fp']);
        $state['csrf'] = is_string($_SESSION['csrf'] ?? null) ? $_SESSION['csrf'] : '';
        if (is_string($_SESSION['unlock_notice'] ?? null) && $_SESSION['unlock_notice'] !== '') {
            $state['notice'] = $_SESSION['unlock_notice'];
            unset($_SESSION['unlock_notice']);
        }
        session_write_close();
    }
    $GLOBALS['__premium_state'] = $state;

    return $state;
}

function premium_state_reset(): void
{
    $GLOBALS['__premium_state'] = null;
}

function premium_unlocked(): bool
{
    return premium_state()['unlocked'];
}

/** Web visitors see premium pages only when unlocked; the CLI always does. */
function premium_visible(): bool
{
    return PHP_SAPI === 'cli' || premium_unlocked();
}

/** @param array<string, mixed> $meta */
function premium_item_hidden(string $type, array $meta): bool
{
    return in_array($type, PREMIUM_TYPES, true)
        && premium_meta_is_premium($meta)
        && !premium_visible();
}

/** Password fields for the bottom sheet and the standalone unlock page. */
function premium_login_fields_html(string $csrf, string $back, string $error): string
{
    $html = '';
    if ($error !== '') {
        $html .= '<p class="unlock-error" role="alert">' . e($error) . '</p>';
    }
    $html .= '<form class="login-sheet__form" method="post" action="' . e(url('unlock.php')) . '" autocomplete="off">'
        . '<input type="hidden" name="action" value="unlock">'
        . '<input type="hidden" name="sheet" value="1">'
        . '<input type="hidden" name="csrf" value="' . e($csrf) . '">'
        . '<input type="hidden" name="back" value="' . e($back) . '">'
        . '<label class="login-sheet__label" for="login-sheet-password">Password</label>'
        . '<input id="login-sheet-password" class="login-sheet__input" type="password" name="password" autocomplete="current-password" required>'
        . '<button type="submit" class="btn btn--small btn--primary">Unlock Premium</button>'
        . '</form>';

    return $html;
}

/**
 * Corner key. Locked: opens a password sheet. Unlocked: locks premium pages.
 */
function premium_key_html(): string
{
    if (PHP_SAPI === 'cli') {
        return '';
    }
    $back = (string) ($_SERVER['REQUEST_URI'] ?? '/');
    $keyIcon = '<svg width="26" height="26" viewBox="0 0 24 24" aria-hidden="true" focusable="false">'
        . '<path fill="currentColor" d="M7 14a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm5.65-4A6 6 0 1 0 12.65 14H17v3h3v-3h2v-4H12.65z"/></svg>';
    $openIcon = '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">'
        . '<rect x="4" y="11" width="16" height="10" rx="1.5"/>'
        . '<path d="M8 11V7.5a4 4 0 0 1 7.8-1.2"/>'
        . '</svg>';
    $state = premium_state();
    $action = url('unlock.php');
    $unlocked = $state['unlocked'] && $state['csrf'] !== '';
    $html = '<div class="site-keys">';
    if ($unlocked) {
        $html .= '<form class="site-key" method="post" action="' . e($action) . '">'
            . '<input type="hidden" name="action" value="lock">'
            . '<input type="hidden" name="csrf" value="' . e($state['csrf']) . '">'
            . '<input type="hidden" name="back" value="' . e($back) . '">'
            . '<button type="submit" class="site-key__btn is-unlocked" aria-label="Lock Premium">'
            . $openIcon
            . '<span class="site-key__hint" aria-hidden="true">Lock Premium</span>'
            . '</button>'
            . '</form>';
    } else {
        $keyHref = $action . '?' . http_build_query(['back' => $back]);
        $notice = (string) ($state['notice'] ?? '');
        $open = $notice !== '' && $state['csrf'] !== '';
        $html .= '<a class="site-key site-key__btn" href="' . e($keyHref) . '" aria-label="Unlock Premium" aria-controls="login-sheet" aria-expanded="false" rel="nofollow">'
            . $keyIcon
            . '<span class="site-key__hint" aria-hidden="true">Unlock Premium</span>'
            . '</a>';
        $html .= '<div class="login-sheet" id="login-sheet" aria-hidden="true"' . ($open ? ' data-open="1"' : '') . '>'
            . '<button type="button" class="login-sheet__backdrop" aria-label="Close"></button>'
            . '<div class="login-sheet__panel" role="dialog" aria-modal="true" aria-labelledby="login-sheet-title">'
            . '<div class="login-sheet__bar" aria-hidden="true"></div>'
            . '<div class="login-sheet__head">'
            . '<h2 id="login-sheet-title" class="login-sheet__title">Unlock Premium</h2>'
            . '<button type="button" class="login-sheet__close" aria-label="Close"><span aria-hidden="true">×</span></button>'
            . '</div>'
            . '<div id="login-sheet-body">'
            . ($open ? premium_login_fields_html($state['csrf'], $back, $notice) : '')
            . '</div>'
            . '</div>'
            . '</div>';
    }
    $html .= '</div>';

    return $html;
}

/** Only same-site relative paths are allowed as a return target. */
function premium_safe_back(string $back): string
{
    $back = trim($back);
    if ($back === '' || $back[0] !== '/' || strncmp($back, '//', 2) === 0
        || strpos($back, '\\') !== false || preg_match('/[\x00-\x1f\x7f]/', $back) === 1
        || strpos($back, 'unlock.php') !== false) {
        return url('index.php');
    }

    return $back;
}

if (PHP_SAPI !== 'cli') {
    premium_state();
}
