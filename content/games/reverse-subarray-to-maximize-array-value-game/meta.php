<?php
declare(strict_types=1);

return [
    'title' => 'Reverse Subarray to Maximize Value: two kinds of gain',
    'leetcode' => 1330,
    'difficulty' => 'Hard',
    'summary' => 'Base = the sum of |a[i] − a[i+1]|. Reversing a prefix or suffix changes one edge: try every edge. Reversing a middle part gains 2 times (max of min(pair) − min of max(pair)) over adjacent pairs.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'reverse-subarray-to-maximize-array-value',
    'related_session' => 'reverse-subarray-to-maximize-array-value',
];
