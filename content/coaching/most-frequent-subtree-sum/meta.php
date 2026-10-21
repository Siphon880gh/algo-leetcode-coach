<?php
declare(strict_types=1);

return [
    'title' => 'Most Frequent Subtree Sum: postorder sums into a counter, return all ties',
    'leetcode' => 508,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: subtree sum = node plus all descendants. Postorder computes each sum from the children, count sums in a hash map, and return all sums with the top count. [5,2,−3] → [2,−3,4]. [5,2,−5] → [2]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'dfs', 'hash-table', 'step-by-step'],
    'related_guide' => 'most-frequent-subtree-sum',
];
