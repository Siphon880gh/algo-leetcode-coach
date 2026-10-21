<?php
declare(strict_types=1);

return [
    'title' => 'Cracking the Safe: a De Bruijn sequence via Hierholzer',
    'leetcode' => 753,
    'difficulty' => 'Hard',
    'summary' => 'Treat each (n − 1)-digit string as a node and each digit appended as an edge. Every n-digit code is one edge, and a walk that uses every edge once (an Eulerian circuit) gives the shortest string, of length kⁿ + n − 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'eulerian-path', 'dfs', 'strings', 'leetcode'],
    'related_session' => 'cracking-the-safe',
];
