<?php
declare(strict_types=1);

return [
    'title' => 'Height of Special Binary Tree: skip the leaf links',
    'leetcode' => 2773,
    'difficulty' => 'Med',
    'summary' => 'Recurse into a child only when it is a real child. Assuming each leaf’s right pointer leads to the next leaf and that leaf’s left pointer leads back, a pointer is a leaf link exactly when the target points straight back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'binary-tree', 'leetcode'],
    'related_session' => 'height-of-special-binary-tree',
];
