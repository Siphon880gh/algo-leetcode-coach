<?php
declare(strict_types=1);

return [
    'title' => 'Determine if a Simple Graph Exists: Erdős–Gallai test',
    'leetcode' => 3656,
    'difficulty' => 'Med',
    'summary' => 'A degree sequence is graphical exactly when its sum is even and, sorted descending, every prefix k satisfies Σ d₁…d_k ≤ k(k − 1) + Σ over the rest of min(d_i, k).',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'array', 'binary-search', 'prefix-sum', 'sorting', 'leetcode'],
    'related_session' => 'determine-if-a-simple-graph-exists',
];
