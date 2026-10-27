<?php
declare(strict_types=1);

return [
    'title' => 'Find the Smallest Balanced Index',
    'leetcode' => 3862,
    'difficulty' => 'Med',
    'summary' => 'Prefix sums give the left side. Sweep from the right with a running product (stop growing it once it exceeds the total sum, since it can never match again). Record every balanced index; the smallest one wins.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-smallest-balanced-index',
    'related_session' => 'find-the-smallest-balanced-index',
];
