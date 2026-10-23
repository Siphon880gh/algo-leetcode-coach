<?php
declare(strict_types=1);

return [
    'title' => 'Number of Alternating XOR Partitions: prefix-XOR DP with two maps',
    'leetcode' => 3811,
    'difficulty' => 'Med',
    'summary' => 'A block from j to i has XOR p[i] ⊕ p[j]. Let one[i] count partitions of the prefix ending in a target1 block and two[i] those ending in a target2 block. Each looks up the other in a map keyed by prefix XOR.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'hash-table', 'dynamic-programming', 'leetcode'],
    'related_session' => 'number-of-alternating-xor-partitions',
];
