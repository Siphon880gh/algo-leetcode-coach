<?php
declare(strict_types=1);

return [
    'title' => 'Number of Good Paths: edges by larger value, product of counts, start at n',
    'leetcode' => 2421,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: add edges in order of their larger end value, add the product of the two counts when maxima match, and start with one path per node. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'number-of-good-paths',
    'tags' => ['array', 'hash-table', 'tree', 'union-find', 'graph', 'sorting', 'step-by-step'],
];
