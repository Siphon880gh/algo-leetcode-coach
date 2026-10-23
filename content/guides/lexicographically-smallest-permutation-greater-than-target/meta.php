<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Smallest Permutation Greater Than Target: longest kept prefix',
    'leetcode' => 3720,
    'difficulty' => 'Med',
    'summary' => 'Keep target’s first i letters (if s has them), put the smallest remaining letter above target[i] at i, and sort the rest. The largest workable i gives the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'hash-table', 'string', 'counting', 'enumeration', 'leetcode'],
    'related_session' => 'lexicographically-smallest-permutation-greater-than-target',
];
