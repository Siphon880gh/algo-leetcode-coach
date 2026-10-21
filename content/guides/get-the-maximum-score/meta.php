<?php
declare(strict_types=1);

return [
    'title' => 'Get the Maximum Score: merge with segment sums',
    'leetcode' => 1537,
    'difficulty' => 'Hard',
    'summary' => 'Walk both sorted arrays like a merge, summing each side between common values. At a common value, both paths continue from max(sum1, sum2) + value.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'greedy', 'dp', 'leetcode'],
    'related_session' => 'get-the-maximum-score',
];
