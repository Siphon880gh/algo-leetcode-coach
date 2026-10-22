<?php
declare(strict_types=1);

return [
    'title' => 'Count Number of Possible Root Nodes: reroot the guess count',
    'leetcode' => 2581,
    'difficulty' => 'Hard',
    'summary' => 'Count correct guesses with node 0 as root. Moving the root from u to a child v only changes the edge between them: lose guess (u, v), gain guess (v, u). One more pass gives every root its count.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'dynamic-programming', 'tree', 'depth-first-search', 'leetcode'],
    'related_session' => 'count-number-of-possible-root-nodes',
];
