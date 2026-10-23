<?php
declare(strict_types=1);

return [
    'title' => 'Concatenated Divisibility: feasibility DP, then greedy',
    'leetcode' => 3533,
    'difficulty' => 'Hard',
    'summary' => 'With n ≤ 13 and k ≤ 100, ok[mask][r] says whether the unused numbers can still finish with remainder 0 when the numbers in mask are placed and the prefix has remainder r. Build the answer by trying numbers in increasing order and keeping the first one that stays feasible.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'dynamic-programming', 'bitmask', 'leetcode'],
    'related_session' => 'concatenated-divisibility',
];
