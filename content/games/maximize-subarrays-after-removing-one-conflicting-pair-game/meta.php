<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Subarrays After Removing One Conflicting Pair',
    'leetcode' => 3480,
    'difficulty' => 'Hard',
    'summary' => 'For each left end l, the subarray can extend up to (smallest b among pairs with a at least l) − 1. Track the smallest and second-smallest b; removing the pair that owns the smallest gains (second − smallest) for those l. Pick the pair with the largest total gain.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-subarrays-after-removing-one-conflicting-pair',
    'related_session' => 'maximize-subarrays-after-removing-one-conflicting-pair',
];
