<?php
declare(strict_types=1);

return [
    'title' => 'Number of Transactions per Visit: counts per visit, then a number series',
    'leetcode' => 1336,
    'difficulty' => 'Hard',
    'summary' => 'Count transactions per visit with a LEFT JOIN, so visits with none count as 0. Generate the series 0..max with a recursive CTE, then LEFT JOIN the per-visit counts onto it and count.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'recursive-cte', 'leetcode'],
    'related_session' => 'number-of-transactions-per-visit',
];
