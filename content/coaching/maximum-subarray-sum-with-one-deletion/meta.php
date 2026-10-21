<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Sum with One Deletion: keep and deleted',
    'leetcode' => 1186,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track keep (best ending here, no deletion) and deleted (best ending here, one deletion), update deleted from the old keep, and take the best of both. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-subarray-sum-with-one-deletion',
    'tags' => ['dynamic-programming', 'arrays', 'step-by-step'],
];
