<?php
declare(strict_types=1);

return [
    'title' => 'Split Array With Minimum Difference',
    'leetcode' => 3698,
    'difficulty' => 'Med',
    'summary' => 'Precompute where the strictly increasing prefix stops and where the strictly decreasing suffix starts. Every split point i where both nums[0..i] is increasing and nums[i+1..] is decreasing is valid; compare |prefix − suffix| with prefix sums.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'split-array-with-minimum-difference',
    'related_session' => 'split-array-with-minimum-difference',
];
