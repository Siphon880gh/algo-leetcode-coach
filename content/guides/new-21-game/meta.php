<?php
declare(strict_types=1);

return [
    'title' => 'New 21 Game: a sliding window of probabilities',
    'leetcode' => 837,
    'difficulty' => 'Med',
    'summary' => 'P[x] is the probability of ever having exactly x points; it is the average of the previous maxPts values that were still below k. Keep their sum in a sliding window, and add up P[x] for k ≤ x ≤ n.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'probability', 'sliding-window', 'leetcode'],
    'related_session' => 'new-21-game',
];
