<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays with Distant Sums',
    'leetcode' => 4051,
    'difficulty' => 'Hard',
    'summary' => 'A subarray sum is P[j + 1] − P[i]. Walking the right end, count earlier prefixes with P[i] ≤ P[j + 1] − goal − k or P[i] ≥ P[j + 1] − goal + k; a sorted list answers both with binary search. With k = 0 every subarray counts.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-subarrays-with-distant-sums',
    'related_session' => 'count-subarrays-with-distant-sums',
];
