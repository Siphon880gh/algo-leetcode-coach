<?php
declare(strict_types=1);

return [
    'title' => 'Decode Ways II: count the ways a star can stand in',
    'leetcode' => 639,
    'difficulty' => 'Hard',
    'summary' => 'Same DP as Decode Ways: f[i] = f[i − 1] · (ways to read one character) + f[i − 2] · (ways to read two). The star only changes those two multipliers.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'leetcode'],
    'related_session' => 'decode-ways-ii',
];
