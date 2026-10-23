<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Select Buildings: count 010 and 101',
    'leetcode' => 2222,
    'difficulty' => 'Med',
    'summary' => 'Track c0, c1 (buildings seen), c01, c10 (alternating pairs). A "0": c10 += c1, total += c01, c0++. A "1": c01 += c0, total += c10, c1++.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-ways-to-select-buildings',
    'related_session' => 'number-of-ways-to-select-buildings',
];
