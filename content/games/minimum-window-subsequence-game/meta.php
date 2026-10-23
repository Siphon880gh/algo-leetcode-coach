<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Window Subsequence: match forward, then shrink backward',
    'leetcode' => 727,
    'difficulty' => 'Hard',
    'summary' => 'From each start, walk s1 forward matching s2 in order. When s2 is done at end e, walk backward from e matching s2 in reverse to find the tightest start. Keep the shortest window (earliest on ties).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-window-subsequence',
    'related_session' => 'minimum-window-subsequence',
];
