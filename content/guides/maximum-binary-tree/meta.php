<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Binary Tree: a decreasing stack builds it in one pass',
    'leetcode' => 654,
    'difficulty' => 'Med',
    'summary' => 'The maximum is the root and the two sides recurse. In one pass, keep a decreasing stack: each new value adopts the last popped node as its left child and becomes the right child of the new stack top.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'monotonic-stack', 'trees', 'divide-and-conquer', 'leetcode'],
    'related_session' => 'maximum-binary-tree',
];
