<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Accepted Invitations: bipartite matching',
    'leetcode' => 1820,
    'difficulty' => 'Med',
    'summary' => 'This is maximum bipartite matching. For each boy, try to find an augmenting path with DFS (Kuhn\'s algorithm): take a free girl, or a girl whose current partner can switch to another.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graph', 'bipartite-matching', 'depth-first-search', 'leetcode'],
    'related_session' => 'maximum-number-of-accepted-invitations',
];
