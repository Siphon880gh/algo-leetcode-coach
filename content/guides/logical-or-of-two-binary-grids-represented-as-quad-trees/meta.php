<?php
declare(strict_types=1);

return [
    'title' => 'Logical OR of Two Quad-Trees: a leaf decides, else recurse and merge',
    'leetcode' => 558,
    'difficulty' => 'Med',
    'summary' => 'OR two quad-trees without building the grids. If one tree is a leaf: when it is all 1s, it is the answer; when it is all 0s, the other tree is. Otherwise OR the four children pairwise, and if all four results are leaves with the same value, collapse them into one leaf.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'kind' => 'algo',
    'tags' => ['divide-and-conquer', 'trees', 'recursion', 'leetcode'],
    'related_session' => 'logical-or-of-two-binary-grids-represented-as-quad-trees',
];
