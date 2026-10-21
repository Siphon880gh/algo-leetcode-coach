<?php
declare(strict_types=1);

return [
    'title' => 'Find Mode in Binary Search Tree: inorder makes equal values adjacent',
    'leetcode' => 501,
    'difficulty' => 'Easy',
    'summary' => 'Return the most frequent value(s) in a BST that allows duplicates. An inorder walk visits values in sorted order, so equal values come in a run. Track the previous value, the current run length, and the best count; reset the answer list when a run beats it, append on a tie. [1,null,2,2] → [2]. Follow-up: O(1) extra besides recursion.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'bst', 'dfs', 'inorder', 'leetcode'],
    'related_session' => 'find-mode-in-binary-search-tree',
];
