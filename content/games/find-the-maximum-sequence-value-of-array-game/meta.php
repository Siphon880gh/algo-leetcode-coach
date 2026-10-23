<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sequence Value: OR sets on both sides of a split',
    'leetcode' => 3287,
    'difficulty' => 'Hard',
    'summary' => 'For every split point, left[i] = set of ORs of k elements chosen from nums[0..i], right[i] = set of ORs of k chosen from nums[i..]. Answer = max over splits of a XOR b for a in left, b in right.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-maximum-sequence-value-of-array',
    'related_session' => 'find-the-maximum-sequence-value-of-array',
];
