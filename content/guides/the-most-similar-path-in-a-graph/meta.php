<?php
declare(strict_types=1);

return [
    'title' => 'The Most Similar Path in a Graph: DP over (position, city)',
    'leetcode' => 1548,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][v] = minimum mismatches for the first i + 1 positions ending at city v. Transition from neighbours u of v; keep a parent table to rebuild the path.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'graph', 'leetcode'],
    'related_session' => 'the-most-similar-path-in-a-graph',
];
