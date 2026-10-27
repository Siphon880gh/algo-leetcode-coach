<?php
declare(strict_types=1);

return [
    'title' => 'Incremental Even-Weighted Cycle Queries',
    'leetcode' => 3887,
    'difficulty' => 'Hard',
    'summary' => 'Keep a DSU that also stores each node\'s parity (XOR of weights) to its root. An edge between two components is always safe: union them with the right parity. An edge inside a component closes a cycle, which is even exactly when parity(u) ⊕ parity(v) = w.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'incremental-even-weighted-cycle-queries',
    'related_session' => 'incremental-even-weighted-cycle-queries',
];
