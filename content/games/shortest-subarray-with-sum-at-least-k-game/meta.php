<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Subarray with Sum at Least K',
    'leetcode' => 862,
    'difficulty' => 'Hard',
    'summary' => 'Prefix sums P with a deque of increasing P values. For each j, pop from the front while P[j] − P[front] at least k (record length); pop from the back while P[back] at least P[j]; push j.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'shortest-subarray-with-sum-at-least-k',
    'related_session' => 'shortest-subarray-with-sum-at-least-k',
];
