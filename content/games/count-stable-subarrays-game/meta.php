<?php
declare(strict_types=1);

return [
    'title' => 'Count Stable Subarrays',
    'leetcode' => 3748,
    'difficulty' => 'Hard',
    'summary' => 'Stable means non-decreasing. Let start[j] be where the non-decreasing run through j begins. Inside [l, r], index j ends max(start[j], l)…j, i.e. j − max(start[j], l) + 1 subarrays. Prefix sums of j − start[j] + 1 plus a binary search for where runs begin after l answer each query fast.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-stable-subarrays',
    'related_session' => 'count-stable-subarrays',
];
