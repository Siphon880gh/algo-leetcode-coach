<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Meals: 22 power-of-two complements',
    'leetcode' => 1711,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each value, add how many earlier values equal 2^p − x for p = 0 … 21, then record x; answer mod 1e9+7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'count-good-meals',
    'tags' => ['hash-map', 'array', 'step-by-step'],
];
