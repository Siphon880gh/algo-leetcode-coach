<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Alternating Subarray Sum: two running states',
    'leetcode' => 2036,
    'difficulty' => 'Med',
    'summary' => 'Track the best alternating sum ending at the current index with a plus sign (pos) and with a minus sign (neg). pos = max(x, neg + x), neg = pos_prev − x; the answer is the best of either.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'array', 'leetcode'],
    'related_session' => 'maximum-alternating-subarray-sum',
];
