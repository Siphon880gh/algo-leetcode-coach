<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Imbalance Numbers of All Subarrays: extend and track gaps',
    'leetcode' => 2763,
    'difficulty' => 'Hard',
    'summary' => 'Fix the left end and extend to the right with a set of seen values. A new value adds a component unless its neighbours x − 1 or x + 1 are already present; the imbalance is the component count minus 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'ordered-set', 'leetcode'],
    'related_session' => 'sum-of-imbalance-numbers-of-all-subarrays',
];
