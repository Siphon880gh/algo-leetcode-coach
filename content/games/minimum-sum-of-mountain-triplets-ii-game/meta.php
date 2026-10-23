<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Sum of Mountain Triplets II',
    'leetcode' => 2909,
    'difficulty' => 'Med',
    'summary' => 'Precompute prefix minimums and suffix minimums. For each middle j with left min < nums[j] > right min, the sum is leftMin + nums[j] + rightMin; take the smallest, or −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-sum-of-mountain-triplets-ii',
    'related_session' => 'minimum-sum-of-mountain-triplets-ii',
];
