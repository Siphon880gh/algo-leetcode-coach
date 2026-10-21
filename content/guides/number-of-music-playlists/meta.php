<?php
declare(strict_types=1);

return [
    'title' => 'Number of Music Playlists: DP on length and distinct songs',
    'leetcode' => 920,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] counts playlists of length i using exactly j distinct songs. The i-th song is either new (n − j + 1 choices) or a replay of one not among the last k played (j − k choices).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'combinatorics', 'leetcode'],
    'related_session' => 'number-of-music-playlists',
];
