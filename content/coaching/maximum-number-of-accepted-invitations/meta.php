<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Accepted Invitations: bipartite matching',
    'leetcode' => 1820,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: Kuhn\'s algorithm; for each boy, DFS for a free girl or one whose partner can switch, with a fresh seen set per boy. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'maximum-number-of-accepted-invitations',
    'tags' => ['graph', 'bipartite-matching', 'depth-first-search', 'step-by-step'],
];
