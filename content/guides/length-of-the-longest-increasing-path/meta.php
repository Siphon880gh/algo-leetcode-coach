<?php
declare(strict_types=1);

return [
    'title' => 'Length of the Longest Increasing Path: LIS on each side of point k',
    'leetcode' => 3288,
    'difficulty' => 'Hard',
    'summary' => 'Keep points strictly below-left of coordinates[k] and strictly above-right. Run a strict LIS on y after sorting by x ascending and y descending, and add both lengths plus 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'sorting', 'longest-increasing-subsequence', 'leetcode'],
    'related_session' => 'length-of-the-longest-increasing-path',
];
