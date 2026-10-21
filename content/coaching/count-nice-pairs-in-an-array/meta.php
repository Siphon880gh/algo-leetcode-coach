<?php
declare(strict_types=1);

return [
    'title' => 'Count Nice Pairs in an Array: group by x − rev(x)',
    'leetcode' => 1814,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: rewrite the condition as x − rev(x) equal on both sides; count keys and add C(c, 2) per key, mod 1e9+7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'count-nice-pairs-in-an-array',
    'tags' => ['hash-table', 'math', 'counting', 'step-by-step'],
];
