<?php
declare(strict_types=1);

return [
    'title' => 'Check for Contradictions in Equations: weighted union-find',
    'leetcode' => 2307,
    'difficulty' => 'Hard',
    'summary' => 'Keep a union-find where each variable stores its ratio to its root. For A / B = v, if A and B share a root, compare ratio(A) / ratio(B) with v within the tolerance; otherwise join the roots with the weight that makes the equation hold.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['array', 'string', 'depth-first-search', 'union-find', 'graph', 'leetcode'],
    'related_session' => 'check-for-contradictions-in-equations',
];
