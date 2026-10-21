<?php
declare(strict_types=1);

return [
    'title' => 'Remove Max Number of Edges to Keep Graph Fully Traversable: two union-finds, shared edges first',
    'leetcode' => 1579,
    'difficulty' => 'Hard',
    'summary' => 'Process type-3 edges first in both Alice\'s and Bob\'s union-finds, then type 1 for Alice and type 2 for Bob. Count useful edges; if either graph stays disconnected return −1, else edges − useful.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'graph', 'leetcode'],
    'related_session' => 'remove-max-number-of-edges-to-keep-graph-fully-traversable',
];
