<?php
declare(strict_types=1);

return [
    'title' => 'Construct Binary Tree from String: recursive descent with one index',
    'leetcode' => 536,
    'difficulty' => 'Med',
    'summary' => 'Parse "4(2(3)(1))(6(5))": a number (maybe negative, maybe many digits), then an optional left child in parentheses, then an optional right child. A recursive parser that shares an index i builds the tree in O(n). Empty string → null. → [4,2,6,3,1,5].',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'recursion', 'stack', 'strings', 'leetcode'],
    'related_session' => 'construct-binary-tree-from-string',
];
