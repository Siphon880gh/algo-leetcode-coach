<?php
declare(strict_types=1);

return [
    'title' => 'Count Pairs of Points With Distance k: split k between x and y',
    'leetcode' => 2857,
    'difficulty' => 'Med',
    'summary' => 'k is at most 100. For each point, try every split k = a + (k − a) and look up the partner (x XOR a, y XOR (k − a)) among earlier points.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'bit-manipulation', 'leetcode'],
    'related_session' => 'count-pairs-of-points-with-distance-k',
];
