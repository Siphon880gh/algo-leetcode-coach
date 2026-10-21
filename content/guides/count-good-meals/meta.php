<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Meals: complement lookup per power of two',
    'leetcode' => 1711,
    'difficulty' => 'Med',
    'summary' => 'Values are at most 2^20, so a pair sum is at most 2^21. For each value, add the count of earlier values equal to 2^p − x for p = 0 … 21, then record x.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-map', 'array', 'leetcode'],
    'related_session' => 'count-good-meals',
];
