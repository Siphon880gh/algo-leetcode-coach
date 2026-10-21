<?php
declare(strict_types=1);

return [
    'title' => 'Delete Columns to Make Sorted III: longest chain of compatible columns',
    'leetcode' => 960,
    'difficulty' => 'Hard',
    'summary' => 'Keep as many columns as possible so that every row is non-decreasing across the kept columns. That is a longest increasing subsequence over columns, where column i can precede j if every row has strs[r][i] ≤ strs[r][j].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'longest-increasing-subsequence', 'leetcode'],
    'related_session' => 'delete-columns-to-make-sorted-iii',
];
