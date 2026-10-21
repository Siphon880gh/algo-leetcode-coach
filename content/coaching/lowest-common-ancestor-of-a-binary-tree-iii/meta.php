<?php
declare(strict_types=1);

return [
    'title' => 'LCA III: parent-pointer two pointers',
    'leetcode' => 1650,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: treat the two ancestor chains as linked lists meeting at the LCA; walk both pointers up and switch each to the other start when it reaches null. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'lowest-common-ancestor-of-a-binary-tree-iii',
    'tags' => ['tree', 'two-pointers', 'hash-set', 'step-by-step'],
];
