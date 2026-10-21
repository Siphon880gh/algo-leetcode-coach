<?php
declare(strict_types=1);

return [
    'title' => 'Count Number of Special Subsequences: three running counts',
    'leetcode' => 1955,
    'difficulty' => 'Hard',
    'summary' => 'Track how many subsequences are of the form 0+ (z), 0+1+ (o) and 0+1+2+ (t). A 0 can extend or skip existing 0-runs, or start one: z = 2z + 1. A 1: o = 2o + z. A 2: t = 2t + o.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'count-number-of-special-subsequences',
];
