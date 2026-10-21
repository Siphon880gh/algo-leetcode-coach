<?php
declare(strict_types=1);

return [
    'title' => 'Number of Transactions per Visit: fill the series',
    'leetcode' => 1336,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: LEFT JOIN visits to transactions and count per visit, generate 0..max with a recursive CTE, LEFT JOIN the counts onto it, and count. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'number-of-transactions-per-visit',
    'tags' => ['sql', 'recursive-cte', 'step-by-step'],
];
