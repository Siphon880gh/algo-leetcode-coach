<?php
declare(strict_types=1);

return [
    'title' => 'Range Sum Query: Mutable (Fenwick tree)',
    'leetcode' => 307,
    'difficulty' => 'Med',
    'summary' => 'A Fenwick (binary indexed) tree stores partial sums: update adds the delta along i += i & −i; a prefix sum walks i −= i & −i. sumRange = prefix(r) − prefix(l − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'range-sum-query-mutable',
    'related_session' => 'range-sum-query-mutable',
];
