<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Increments on Subarrays to Form a Target Array: count rises',
    'leetcode' => 1526,
    'difficulty' => 'Hard',
    'summary' => 'Each rise from target[i−1] to target[i] needs that many new operations starting at i; drops are covered by extending earlier ones. Answer = target[0] + Σ max(0, target[i] − target[i−1]).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'arrays', 'leetcode'],
    'related_session' => 'minimum-number-of-increments-on-subarrays-to-form-a-target-array',
];
