<?php
declare(strict_types=1);

return [
    'title' => 'Remove Max Edges to Keep Graph Traversable: two DSUs',
    'leetcode' => 1579,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: add type-3 edges first into both DSUs, then type 1 into Alice\'s and type 2 into Bob\'s; count useful edges; both must end connected. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'remove-max-number-of-edges-to-keep-graph-fully-traversable',
    'tags' => ['union-find', 'graph', 'step-by-step'],
];
