<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Operations to Make Elements in Array Distinct: last duplicate from the right',
    'leetcode' => 3396,
    'difficulty' => 'Easy',
    'summary' => 'Scan from the right with a set. The first value already in the set sits at index i; everything up to i must go, which takes ⌊i / 3⌋ + 1 operations.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'leetcode'],
    'related_session' => 'minimum-number-of-operations-to-make-elements-in-array-distinct',
];
