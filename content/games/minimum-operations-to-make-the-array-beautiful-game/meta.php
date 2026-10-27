<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make the Array Beautiful',
    'leetcode' => 3717,
    'difficulty' => 'Med',
    'summary' => 'DP over the value the previous element ended at. For each reachable previous value p, the current element can become any multiple of p that is at least nums[i]; cost is the increase. Keep the cheapest cost per final value.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-make-the-array-beautiful',
    'related_session' => 'minimum-operations-to-make-the-array-beautiful',
];
