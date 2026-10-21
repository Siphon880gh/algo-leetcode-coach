<?php
declare(strict_types=1);

return [
    'title' => 'Construct Binary Tree from String: recursive descent with one index',
    'leetcode' => 536,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: build a tree from "4(2(3)(1))(6(5))". Recursive descent with one shared index: read a signed multi-digit number, then an optional left subtree in parentheses, then an optional right. "" → null. → [4,2,6,3,1,5]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'recursion', 'stack', 'strings', 'step-by-step'],
    'related_guide' => 'construct-binary-tree-from-string',
];
