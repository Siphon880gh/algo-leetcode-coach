<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Cut a Stick: interval DP over cut points',
    'leetcode' => 1547,
    'difficulty' => 'Hard',
    'summary' => 'Add 0 and n to the sorted cuts. dp[i][j] = cheapest way to make every cut strictly between points i and j: the first cut there costs c[j] − c[i], then the two sides are independent.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'interval-dp', 'leetcode'],
    'related_session' => 'minimum-cost-to-cut-a-stick',
];
