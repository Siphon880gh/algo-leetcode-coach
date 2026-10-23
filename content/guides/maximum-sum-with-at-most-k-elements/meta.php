<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum With at Most K Elements: row caps, then the global top k',
    'leetcode' => 3462,
    'difficulty' => 'Med',
    'summary' => 'Each row can only contribute its limits[i] largest values, so collect those candidates and take the k largest of them. Values are non-negative, so taking more never hurts.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'matrix', 'sorting', 'heap', 'leetcode'],
    'related_session' => 'maximum-sum-with-at-most-k-elements',
];
