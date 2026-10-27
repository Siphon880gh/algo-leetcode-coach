<?php
declare(strict_types=1);

return [
    'title' => 'Split Array with Equal Sum',
    'leetcode' => 548,
    'difficulty' => 'Hard',
    'summary' => 'Fix the middle cut j. For each i on the left where sum(0 to i−1) = sum(i+1 to j−1), put that sum in a set; then scan k on the right for sum(j+1 to k−1) = sum(k+1 to n−1) in the set.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'split-array-with-equal-sum',
    'related_session' => 'split-array-with-equal-sum',
];
