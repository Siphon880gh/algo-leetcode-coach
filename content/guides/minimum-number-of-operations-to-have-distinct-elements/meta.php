<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Operations to Have Distinct Elements: last duplicate from the right',
    'leetcode' => 3779,
    'difficulty' => 'Med',
    'summary' => 'Scan from the right with a set. The first value seen twice, at index i, means the prefix through i must go: ⌈(i + 1) / 3⌉ operations.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'leetcode'],
    'related_session' => 'minimum-number-of-operations-to-have-distinct-elements',
];
