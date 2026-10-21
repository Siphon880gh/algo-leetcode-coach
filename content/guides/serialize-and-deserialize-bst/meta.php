<?php
declare(strict_types=1);

return [
    'title' => 'Serialize and Deserialize BST: preorder only, rebuild with value bounds',
    'leetcode' => 449,
    'difficulty' => 'Med',
    'summary' => 'Encode a BST as compactly as you can. Preorder values are enough — no null markers — because BST order tells you where each value goes. Rebuild with recursion that accepts the next value only inside (low, high). [2,1,3] → "2 1 3" → [2,1,3]. Not 297 (general tree needs nulls).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'bst', 'dfs', 'design', 'leetcode'],
    'related_session' => 'serialize-and-deserialize-bst',
];
