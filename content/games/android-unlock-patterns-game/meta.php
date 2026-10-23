<?php
declare(strict_types=1);

return [
    'title' => 'Android Unlock Patterns',
    'leetcode' => 351,
    'difficulty' => 'Med',
    'summary' => 'DFS from each start key with a visited set; moving between two keys that have a key in between (e.g. 1→3 over 2) is allowed only if that middle key was visited. Use symmetry: corners × 4, edges × 4, center × 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'android-unlock-patterns',
    'related_session' => 'android-unlock-patterns',
];
