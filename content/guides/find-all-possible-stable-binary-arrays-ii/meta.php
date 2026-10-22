<?php
declare(strict_types=1);

return [
    'title' => 'Find All Possible Stable Binary Arrays II: subtract the too-long run',
    'leetcode' => 3130,
    'difficulty' => 'Hard',
    'summary' => 'Append a 0 to any array with i − 1 zeros, then subtract the arrays where that makes a run of limit + 1 zeros: those are dp[i − limit − 1][j][1] (a 1 just before the run).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'find-all-possible-stable-binary-arrays-ii',
];
