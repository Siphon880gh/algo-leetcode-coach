<?php
declare(strict_types=1);

return [
    'title' => 'Number of Beautiful Partitions: check both ends, a cut needs non-prime then prime',
    'leetcode' => 2478,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: return 0 when the string cannot start or end a part, and allow a cut only between a non-prime digit and a prime digit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-beautiful-partitions',
    'tags' => ['string', 'dynamic-programming', 'prefix-sum', 'step-by-step'],
];
