<?php
declare(strict_types=1);

return [
    'title' => 'Smallest String Starting From Leaf: compare full leaf-to-root strings',
    'leetcode' => 988,
    'difficulty' => 'Med',
    'summary' => 'DFS from the root, building the path. At each leaf, read the path from leaf to root and keep the smallest such string. Comparing whole strings is required: a greedy choice of the smaller child can be wrong.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'depth-first-search', 'strings', 'leetcode'],
    'related_session' => 'smallest-string-starting-from-leaf',
];
