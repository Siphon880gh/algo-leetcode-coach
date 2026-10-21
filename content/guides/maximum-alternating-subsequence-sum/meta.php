<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Alternating Subsequence Sum: two-state DP',
    'leetcode' => 1911,
    'difficulty' => 'Med',
    'summary' => 'Track the best sum of a chosen subsequence whose next element would be added (even length so far) and whose next would be subtracted (odd length). Each element either extends one state or is skipped.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'array', 'leetcode'],
    'related_session' => 'maximum-alternating-subsequence-sum',
];
