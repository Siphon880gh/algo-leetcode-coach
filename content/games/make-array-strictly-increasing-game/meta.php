<?php
declare(strict_types=1);

return [
    'title' => 'Make Array Strictly Increasing: map last value to fewest operations',
    'leetcode' => 1187,
    'difficulty' => 'Hard',
    'summary' => 'State: map from the last value to the fewest operations. For each arr1[i]: keep it if it exceeds the last value; or replace it with the smallest arr2 value above the last value (+1 op).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'make-array-strictly-increasing',
    'related_session' => 'make-array-strictly-increasing',
];
