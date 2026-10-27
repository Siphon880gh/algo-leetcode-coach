<?php
declare(strict_types=1);

return [
    'title' => 'Largest Magic Square',
    'leetcode' => 1895,
    'difficulty' => 'Med',
    'summary' => 'Try sizes k from min(m, n) down to 2; for each k by k window check all row, column and both diagonal sums are equal (row or column prefix sums make each check O(k)). Size 1 always works.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'largest-magic-square',
    'related_session' => 'largest-magic-square',
];
