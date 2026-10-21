<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Total Beauty of the Gardens: fill the largest, raise the rest',
    'leetcode' => 2234,
    'difficulty' => 'Hard',
    'summary' => 'Cap flowers at target and sort. Try every count j of full gardens taken from the largest. With the flowers left, binary search the highest minimum the other gardens can reach below target, and score j · full + min · partial.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'binary-search', 'greedy', 'sorting', 'enumeration', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-total-beauty-of-the-gardens',
];
