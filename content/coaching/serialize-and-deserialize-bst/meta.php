<?php
declare(strict_types=1);

return [
    'title' => 'Serialize and Deserialize BST: preorder only, rebuild with value bounds',
    'leetcode' => 449,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: serialize a BST as compactly as you can. Preorder values alone are enough; no null markers. Deserialize with recursion that accepts the next value only inside (low, high), else returns null. [2,1,3] → "2 1 3" → [2,1,3]. Not 297. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'bst', 'dfs', 'design', 'step-by-step'],
    'related_guide' => 'serialize-and-deserialize-bst',
];
