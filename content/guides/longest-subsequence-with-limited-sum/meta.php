<?php
declare(strict_types=1);

return [
    'title' => 'Longest Subsequence With Limited Sum: smallest values first, binary search the prefix',
    'leetcode' => 2389,
    'difficulty' => 'Easy',
    'summary' => 'Order does not matter for a sum, so the biggest subsequence under a limit takes the smallest values. Sort, build prefix sums, and binary search each query for how many prefixes fit.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'greedy', 'sorting', 'prefix-sum', 'leetcode'],
    'related_session' => 'longest-subsequence-with-limited-sum',
];
