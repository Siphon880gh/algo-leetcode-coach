<?php
/**
 * JSON rows for the "Problems with most interviews" slide-in panel.
 * GET ?type=games|guides|coaching → {"type": ..., "rows": [{n, slug, title, difficulty, companies, url}]}
 * Sorted by distinct company count (most first), then problem number. Problems no company tags are left out.
 */
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/problem_tools.php';

$type = isset($_GET['type']) ? (string) $_GET['type'] : '';
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
if (!isset(problem_panel_types()[$type])) {
    http_response_code(400);
    echo json_encode(['error' => 'type must be games, guides, or coaching']);
    exit;
}
echo json_encode(
    ['type' => $type, 'rows' => problem_panel_rows($type)],
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
);
