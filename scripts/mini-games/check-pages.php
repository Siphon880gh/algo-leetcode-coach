<?php
// Fetch every game's play page from a running local server and check it:
// HTTP 200, no PHP error output, the problem panel is present, and the panel shows
// either the statement (with its images and the Algo Guide link) or, for locked
// premium problems, the fallback without leaking the statement body.
//
// usage: php -S 127.0.0.1:8765          (from the repo root, in another terminal)
//        php scripts/mini-games/check-pages.php [base-url]   (default http://127.0.0.1:8765)
declare(strict_types=1);

$root = dirname(__DIR__, 2);
chdir($root);
$base = rtrim($argv[1] ?? 'http://127.0.0.1:8765', '/');
$bad = 0; $ok = 0; $locked = 0;
$phpError = '/(Fatal error|Warning|Notice|Parse error|Deprecated)(<\/b>)?:.{0,400}? on line (<b>)?\d+|Uncaught [A-Z]\w*(Error|Exception)/s';

foreach (glob('content/games/*-game/meta.php') as $f) {
    $slug = basename(dirname($f));
    $m = require $f;
    $n = (int) ($m['leetcode'] ?? 0);
    $ctx = stream_context_create(['http' => ['ignore_errors' => true]]);
    $html = @file_get_contents("$base/games/play.php?id=" . rawurlencode($slug), false, $ctx);
    $err = [];
    if ($html === false) { echo "Cannot reach $base; start the server with: php -S 127.0.0.1:8765\n"; exit(2); }
    $code = (int) (explode(' ', $http_response_header[0] ?? '')[1] ?? 0);
    if ($code !== 200) $err[] = "HTTP $code";
    if (preg_match($phpError, $html)) $err[] = 'PHP error output';
    if (!preg_match('#<details class="problem-statement[^"]*game-problem" id="problem" open>(.*?)</details>#s', $html, $mm)) {
        $err[] = 'no problem panel';
    } else {
        $panel = $mm[1];
        $file = "content/problems/$n.html";
        if (is_file($file)) {
            $txt = trim(html_entity_decode(strip_tags(file_get_contents($file))));
            $probe = mb_substr(preg_replace('/\s+/', ' ', $txt), 0, 40);
            $ptxt = preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($panel)));
            if (strpos($ptxt, $probe) === false) $err[] = 'statement text missing';
            if (substr_count(file_get_contents($file), '<img') !== substr_count($panel, '<img')) $err[] = 'image count differs';
            if (stripos($panel, 'Algo Guide') === false) $err[] = 'no guide link';
        } elseif (strpos($panel, 'problem-statement__fallback') !== false) {
            $locked++;
            if (strpos($panel, 'problem-statement__body') !== false) $err[] = 'locked statement leaked';
        } elseif (strpos($panel, 'problem-statement__body') === false) {
            $err[] = 'no statement and no fallback';
        }
        if ($n && strpos($panel, "Problem: $n.") === false) $err[] = 'no title';
    }
    if ($err) { $bad++; echo "BAD $slug: " . implode(', ', $err) . "\n"; } else { $ok++; }
}
echo "pages ok $ok bad $bad (locked premium fallback: $locked)\n";
exit($bad ? 1 : 0);
