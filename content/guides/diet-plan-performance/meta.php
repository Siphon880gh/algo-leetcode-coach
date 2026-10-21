<?php
declare(strict_types=1);

return [
    'title' => 'Diet Plan Performance: sliding window of k days',
    'leetcode' => 1176,
    'difficulty' => 'Easy',
    'summary' => 'Keep a running sum of the last k days. For each full window, subtract 1 below lower, add 1 above upper, and slide by adding the new day and dropping the old.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'arrays', 'leetcode'],
    'related_session' => 'diet-plan-performance',
];
