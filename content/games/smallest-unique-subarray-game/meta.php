<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Unique Subarray',
    'leetcode' => 3934,
    'difficulty' => 'Hard',
    'summary' => 'If some length-L subarray occurs only once, extending it gives a unique length-(L+1) subarray, so the property is monotone in L. Binary search L; for each candidate, count rolling hashes of every length-L window and check whether any count is 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'smallest-unique-subarray',
    'related_session' => 'smallest-unique-subarray',
];
