<?php
declare(strict_types=1);

return [
    'title' => 'Expression Tree With Evaluate: postfix stack',
    'leetcode' => 1628,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: numbers push leaves; an operator pops right then left and pushes an operator node; evaluate recursively through polymorphic nodes. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-an-expression-tree-with-evaluate-function',
    'tags' => ['design', 'stack', 'tree', 'step-by-step'],
];
