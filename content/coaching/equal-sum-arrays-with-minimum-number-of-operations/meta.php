<?php
declare(strict_types=1);

return [
    'title' => 'Equal Sum Arrays With Minimum Number of Operations: biggest gains first',
    'leetcode' => 1775,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: make nums1 the smaller-sum array; gains are 6 − x there and x − 1 in the other; take gains largest first until the gap closes, else −1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'equal-sum-arrays-with-minimum-number-of-operations',
    'tags' => ['greedy', 'counting', 'array', 'step-by-step'],
];
