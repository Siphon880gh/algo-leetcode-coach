<?php
declare(strict_types=1);

return [
    'title' => 'Tree of Coprimes: DFS with a stack per value',
    'leetcode' => 1766,
    'difficulty' => 'Hard',
    'summary' => 'Values are at most 50. During DFS keep, for each value, a stack of (node, depth) for ancestors holding it. At a node, check the 50 values coprime with its own and take the deepest top.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'math', 'leetcode'],
    'related_session' => 'tree-of-coprimes',
];
