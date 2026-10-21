<?php
declare(strict_types=1);

return [
    'title' => 'Incremental Memory Leak: simulate',
    'leetcode' => 1860,
    'difficulty' => 'Med',
    'summary' => 'At second i, take i bits from the stick with more free memory (stick 1 on ties); crash when that stick has fewer than i. The loop runs only O(√(m1 + m2)) times.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'kind' => 'algo',
    'tags' => ['simulation', 'math', 'leetcode'],
    'related_session' => 'incremental-memory-leak',
];
