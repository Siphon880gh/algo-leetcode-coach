<?php
declare(strict_types=1);

return [
    'title' => 'The K Weakest Rows in a Matrix: soldiers then index',
    'leetcode' => 1337,
    'difficulty' => 'Easy',
    'summary' => 'Each row is ones followed by zeros, so binary search the soldier count per row. Sort rows by (soldiers, index), or keep a heap of size k, and return the first k indices.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['binary-search', 'heap', 'sorting', 'leetcode'],
    'related_session' => 'the-k-weakest-rows-in-a-matrix',
];
