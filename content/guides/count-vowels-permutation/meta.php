<?php
declare(strict_types=1);

return [
    'title' => 'Count Vowels Permutation: five counters by last letter',
    'leetcode' => 1220,
    'difficulty' => 'Hard',
    'summary' => 'Track how many strings of the current length end in each vowel. The rules say which vowel may follow which, so each next count is a sum of allowed predecessors, mod 10⁹ + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'count-vowels-permutation',
];
