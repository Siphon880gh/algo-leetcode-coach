<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With Majority Element II',
    'leetcode' => 3739,
    'difficulty' => 'Hard',
    'summary' => 'Map target to +1 and everything else to −1, and take prefix sums P. Subarray (i, j] works when P[j] > P[i]. Sweep j and count earlier prefixes below P[j] with a Fenwick tree (or, since P moves by ±1, a running count).',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-subarrays-with-majority-element-ii',
    'related_session' => 'count-subarrays-with-majority-element-ii',
];
