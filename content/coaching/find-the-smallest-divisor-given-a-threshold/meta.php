<?php
declare(strict_types=1);

return [
    'title' => 'Find the Smallest Divisor Given a Threshold: binary search on d',
    'leetcode' => 1283,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the sum of ceil(x / d) falls as d grows, so binary search d in [1, max(nums)] for the smallest value whose sum is at most the threshold. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'find-the-smallest-divisor-given-a-threshold',
    'tags' => ['binary-search', 'step-by-step'],
];
