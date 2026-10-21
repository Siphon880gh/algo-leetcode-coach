<?php
declare(strict_types=1);

return [
    'title' => 'Find the Missing IDs: recursive series',
    'leetcode' => 1613,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: generate 1 … max id with a recursive CTE, anti-join with the table, order the result. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'find-the-missing-ids',
    'tags' => ['sql', 'recursive-cte', 'step-by-step'],
];
