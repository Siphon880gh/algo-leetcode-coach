<?php
declare(strict_types=1);

return [
    'title' => 'Create Components With Same Value: try each component count, cut at the target',
    'leetcode' => 2440,
    'difficulty' => 'Hard',
    'summary' => 'If the tree splits into k equal parts, each sums to total / k. Try k from n down; a DFS returns each subtree’s leftover sum, cutting whenever a subtree reaches the target and failing when it exceeds it. The first k that works gives k − 1 deletions.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'tree', 'depth-first-search', 'enumeration', 'leetcode'],
    'related_session' => 'create-components-with-same-value',
];
