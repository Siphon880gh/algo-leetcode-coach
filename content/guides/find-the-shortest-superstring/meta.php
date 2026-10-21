<?php
declare(strict_types=1);

return [
    'title' => 'Find the Shortest Superstring: bitmask DP over overlaps',
    'leetcode' => 943,
    'difficulty' => 'Hard',
    'summary' => 'The shortest superstring is the order of words that saves the most overlap. Precompute overlap[i][j], run dp[mask][last] = best total overlap using the words in mask and ending with last, then rebuild the order.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'strings', 'leetcode'],
    'related_session' => 'find-the-shortest-superstring',
];
