<?php
declare(strict_types=1);

return [
    'title' => 'Sorting Three Groups: longest non-decreasing subsequence of 1s, 2s and 3s',
    'leetcode' => 2826,
    'difficulty' => 'Med',
    'summary' => 'keep[v] = longest non-decreasing subsequence ending with value at most v. For x: keep[x] = max(keep[1 to x]) + 1. Removals = n − max keep.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'sorting-three-groups',
    'related_session' => 'sorting-three-groups',
];
