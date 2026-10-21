<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Subtree with all the Deepest Nodes: return depth and candidate together',
    'leetcode' => 865,
    'difficulty' => 'Med',
    'summary' => 'One post-order pass returns (depth, node) for each subtree. If both children are equally deep, the current node is the answer for this subtree; otherwise pass up the deeper side\'s node.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'depth-first-search', 'recursion', 'leetcode'],
    'related_session' => 'smallest-subtree-with-all-the-deepest-nodes',
];
