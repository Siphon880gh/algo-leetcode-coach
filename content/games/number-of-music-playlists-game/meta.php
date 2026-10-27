<?php
declare(strict_types=1);

return [
    'title' => 'Number of Music Playlists: new song or replay',
    'leetcode' => 920,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = playlists of length i using exactly j distinct songs. New song: dp[i−1][j−1] times (n − j + 1). Replay: dp[i−1][j] times max(j − k, 0).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-music-playlists',
    'related_session' => 'number-of-music-playlists',
];
