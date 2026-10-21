<?php
declare(strict_types=1);

return [
    'title' => 'Convert BST to Sorted Doubly Linked List: inorder stitch, then close the circle',
    'leetcode' => 426,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: turn a BST into a sorted circular doubly linked list in place. left is prev, right is next. Inorder walk links each node to the previous visit; the first visit is head. Then link last and first. [4,2,5,1,3] → 1↔2↔3↔4↔5↔1. Not 114. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'bst', 'linked-list', 'step-by-step'],
    'related_guide' => 'convert-binary-search-tree-to-sorted-doubly-linked-list',
];
