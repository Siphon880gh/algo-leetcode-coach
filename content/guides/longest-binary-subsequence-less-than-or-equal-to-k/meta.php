<?php
declare(strict_types=1);

return [
    'title' => 'Longest Binary Subsequence Less Than or Equal to K: all zeros, then cheap ones',
    'leetcode' => 2311,
    'difficulty' => 'Med',
    'summary' => 'Every 0 can be kept, since leading zeros add nothing. Then take 1s from the right, each worth 2 to the power of its distance from the end, while the value stays ≤ k.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['string', 'greedy', 'dynamic-programming', 'memoization', 'leetcode'],
    'related_session' => 'longest-binary-subsequence-less-than-or-equal-to-k',
];
