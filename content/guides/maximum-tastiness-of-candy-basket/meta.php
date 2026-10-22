<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Tastiness of Candy Basket: binary search the gap, pick greedily',
    'leetcode' => 2517,
    'difficulty' => 'Med',
    'summary' => 'Sort the prices. For a gap d, greedily take the cheapest candy and then each next candy at least d above the last one taken; d works if that yields k candies. Binary search the largest workable d.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'greedy', 'sorting', 'leetcode'],
    'related_session' => 'maximum-tastiness-of-candy-basket',
];
