<?php
declare(strict_types=1);

return [
    'title' => 'Find Permutation: start from 1..n+1, reverse every D run',
    'leetcode' => 484,
    'difficulty' => 'Med',
    'summary' => 'Given an I/D signature, return the lexicographically smallest permutation of 1..n+1 that matches it. Start with [1, 2, …, n + 1]. For every maximal run of D covering positions i..j − 1, reverse the block i..j. "I" → [1,2]. "DI" → [2,1,3]. "IDDI" → [1,4,3,2,5]. Not 942.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'stack', 'arrays', 'leetcode'],
    'related_session' => 'find-permutation',
];
