<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Triplets: triple loop with pruning',
    'leetcode' => 1534,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: loop i < j, skip when |a[i] − a[j]| > a, then loop k > j checking the other two bounds. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'related_guide' => 'count-good-triplets',
    'tags' => ['arrays', 'enumeration', 'step-by-step'],
];
