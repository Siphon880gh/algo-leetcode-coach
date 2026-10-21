<?php
declare(strict_types=1);

return [
    'title' => 'Smallest String Starting From Leaf: compare at the leaves',
    'leetcode' => 988,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: DFS with the path, and at each leaf compare the leaf-to-root string with the best so far; choosing the smaller child letter greedily is not safe. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'smallest-string-starting-from-leaf',
    'tags' => ['trees', 'depth-first-search', 'strings', 'step-by-step'],
];
