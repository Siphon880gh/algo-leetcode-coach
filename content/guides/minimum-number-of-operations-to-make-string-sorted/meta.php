<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Operations to Make String Sorted: rank of the permutation',
    'leetcode' => 1830,
    'difficulty' => 'Hard',
    'summary' => 'Each operation turns s into the previous permutation in lexicographic order, so the answer is the number of distinct permutations smaller than s. For each position, count arrangements with a smaller letter there using factorials and inverse factorials mod 1e9+7.',
    'category' => 'LeetCode',
    'subcategory' => 'Combinatorics',
    'topic' => 'LeetCode · Combinatorics',
    'kind' => 'algo',
    'tags' => ['math', 'combinatorics', 'string', 'leetcode'],
    'related_session' => 'minimum-number-of-operations-to-make-string-sorted',
];
