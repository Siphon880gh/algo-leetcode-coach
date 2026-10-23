<?php
declare(strict_types=1);

return [
    'title' => 'Longest Increasing Path Through Point k',
    'leetcode' => 3288,
    'difficulty' => 'Hard',
    'summary' => 'Keep points strictly below-left of k and strictly above-right. In each group, sort by x ascending (y descending on ties) and take the LIS of y with binary search. Answer = both + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'length-of-the-longest-increasing-path',
    'related_session' => 'length-of-the-longest-increasing-path',
];
