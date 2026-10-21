<?php
declare(strict_types=1);

return [
    'title' => 'Non-decreasing Array: fix the first dip the safe way',
    'leetcode' => 665,
    'difficulty' => 'Med',
    'summary' => 'At the first i with nums[i] > nums[i + 1], decide which side to change: lower nums[i] if nums[i − 1] allows it, otherwise raise nums[i + 1]. A second dip means false.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'arrays', 'leetcode'],
    'related_session' => 'non-decreasing-array',
];
