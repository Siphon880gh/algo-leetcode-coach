<?php
declare(strict_types=1);

return [
    'title' => 'Assign Elements to Groups with Constraints: sieve from each first index',
    'leetcode' => 3447,
    'difficulty' => 'Med',
    'summary' => 'Go through elements by index, skipping repeated values. Each new value marks all its multiples up to the largest group that are still unassigned, so every group gets the smallest index that divides it.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'leetcode'],
    'related_session' => 'assign-elements-to-groups-with-constraints',
];
