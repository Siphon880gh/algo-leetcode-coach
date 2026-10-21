<?php
declare(strict_types=1);

return [
    'title' => 'Previous Permutation With One Swap: rightmost descent',
    'leetcode' => 1053,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: find the last i with arr[i] > arr[i + 1], then swap it with the largest smaller value to its right, choosing the leftmost copy of that value. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'previous-permutation-with-one-swap',
    'tags' => ['greedy', 'arrays', 'step-by-step'],
];
