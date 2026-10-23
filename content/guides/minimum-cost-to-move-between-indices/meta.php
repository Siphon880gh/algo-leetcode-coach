<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Move Between Indices: prefix sums of step costs',
    'leetcode' => 3919,
    'difficulty' => 'Med',
    'summary' => 'Values are increasing, so a jump costs the same as walking the steps between. Each step costs 1 if it is a closest move, else the value gap, so two prefix sums (one per direction) answer every query.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-cost-to-move-between-indices',
];
