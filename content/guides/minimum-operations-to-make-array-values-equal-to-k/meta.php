<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make Array Values Equal to K: count distinct values above k',
    'leetcode' => 3375,
    'difficulty' => 'Easy',
    'summary' => 'Values can only go down, so any value below k makes it impossible. Otherwise each operation can lower the current largest value to the next distinct value, so the answer is the number of distinct values above k.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-array-values-equal-to-k',
];
