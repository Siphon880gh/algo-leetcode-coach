<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score After Splitting a String: zeros left plus ones right',
    'leetcode' => 1422,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: start with ones = total ones, then for each split i in 1..n−1 update zeros and ones and take the max. Both parts must be non-empty. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'maximum-score-after-splitting-a-string',
    'tags' => ['prefix-sum', 'strings', 'step-by-step'],
];
