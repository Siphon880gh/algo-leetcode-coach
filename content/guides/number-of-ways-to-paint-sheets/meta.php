<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Paint Sheets: count splits per color pair',
    'leetcode' => 3802,
    'difficulty' => 'Hard',
    'summary' => 'Cap each limit at n − 1 as c. For an ordered pair of colors (i, j), the first block can have x sheets for max(1, n − c_j) ≤ x ≤ c_i, which is max(0, c_i + c_j − n + 1) ways. Sort c and sum over pairs with binary search and prefix sums.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'leetcode'],
    'related_session' => 'number-of-ways-to-paint-sheets',
];
