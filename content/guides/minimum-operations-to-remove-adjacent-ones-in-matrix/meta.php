<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Remove Adjacent Ones in Matrix: bipartite matching',
    'leetcode' => 2123,
    'difficulty' => 'Hard',
    'summary' => 'Adjacent 1s form a bipartite graph (colour cells by (r + c) parity). The fewest 1s to remove so no edge remains is a minimum vertex cover, which by König\'s theorem equals the maximum matching. Run augmenting paths from the even cells.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'bipartite-matching', 'matrix', 'leetcode'],
    'related_session' => 'minimum-operations-to-remove-adjacent-ones-in-matrix',
];
