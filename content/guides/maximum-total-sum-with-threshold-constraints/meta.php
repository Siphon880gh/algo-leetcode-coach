<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Total Sum with Threshold Constraints: the stopping step is fixed',
    'leetcode' => 3763,
    'difficulty' => 'Med',
    'summary' => 'At step s the number of usable indices is (thresholds ≤ s) − (s − 1), whatever was picked before. So the process stops at the same step every time, and by then every index with threshold ≤ T has been used.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'sorting', 'heap', 'leetcode'],
    'related_session' => 'maximum-total-sum-with-threshold-constraints',
];
