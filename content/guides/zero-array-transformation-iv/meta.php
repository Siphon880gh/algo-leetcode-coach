<?php
declare(strict_types=1);

return [
    'title' => 'Zero Array Transformation IV: subset sums per index',
    'leetcode' => 3489,
    'difficulty' => 'Med',
    'summary' => 'Each index is independent: it reaches 0 once nums[j] is a subset sum of the vals of the queries covering it. Track a bitset per index and record the first query count that hits nums[j]; the answer is the largest.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'zero-array-transformation-iv',
];
