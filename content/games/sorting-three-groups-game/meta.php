<?php
declare(strict_types=1);

return [
    'title' => 'Sorting Three Groups: longest non-decreasing subsequence of 1/2/3',
    'leetcode' => 2826,
    'difficulty' => 'Med',
    'summary' => 'keep[v] = longest non-decreasing subsequence ending with value ≤ v. For x: keep[x] = max(keep[1..x]) + 1. Removals = n − max keep.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'sorting-three-groups',
    'related_session' => 'sorting-three-groups',
];
