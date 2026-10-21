<?php
declare(strict_types=1);

return [
    'title' => 'Check if an Original String Exists Given Two Encoded Strings: DP with a length gap',
    'leetcode' => 2060,
    'difficulty' => 'Hard',
    'summary' => 'Walk both strings with a memoised DFS over (i, j, diff), where diff is how many more wildcard characters s1 has pending than s2. Digit runs add to diff in every possible split; a letter consumes a pending wildcard on the other side or must match a letter when diff is 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'string', 'memoization', 'leetcode'],
    'related_session' => 'check-if-an-original-string-exists-given-two-encoded-strings',
];
