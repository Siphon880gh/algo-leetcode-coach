<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Sum After At Most K Swaps',
    'leetcode' => 3962,
    'difficulty' => 'Hard',
    'summary' => 'Fix the subarray. Each swap trades its smallest inside value for the largest outside value while that helps, up to k times. Grow each left end to the right and keep the inside values in a sorted structure and the outside values in another, adjusting as elements move across.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'tags' => ['sorting', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-subarray-sum-after-at-most-k-swaps',
    'related_session' => 'maximum-subarray-sum-after-at-most-k-swaps',
];
