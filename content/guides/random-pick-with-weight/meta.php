<?php
declare(strict_types=1);

return [
    'title' => 'Random Pick with Weight: prefix sums and binary search',
    'leetcode' => 528,
    'difficulty' => 'Med',
    'summary' => 'pickIndex() returns i with probability w[i] / sum(w). Build prefix sums; draw x uniform in [1, total]; return the first index whose prefix is ≥ x (bisect_left). [1,3] → index 1 three times as often as index 0. Basis for 497.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'prefix-sum', 'probability', 'randomized', 'leetcode'],
    'related_session' => 'random-pick-with-weight',
];
