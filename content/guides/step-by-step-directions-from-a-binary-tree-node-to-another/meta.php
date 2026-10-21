<?php
declare(strict_types=1);

return [
    'title' => 'Step-By-Step Directions From a Binary Tree Node to Another: root paths minus the common prefix',
    'leetcode' => 2096,
    'difficulty' => 'Med',
    'summary' => 'Record the L/R path from the root to start and to dest, drop their common prefix (the part above the lowest common ancestor), turn what is left of the start path into U, and append the rest of the dest path.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'dfs', 'string', 'leetcode'],
    'related_session' => 'step-by-step-directions-from-a-binary-tree-node-to-another',
];
