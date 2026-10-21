<?php
declare(strict_types=1);

return [
    'title' => 'Number of Music Playlists: new song or replay',
    'leetcode' => 920,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i][j] counts playlists of length i with j distinct songs; the next song is new (n − j + 1 ways) or a replay outside the last k (j − k ways). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-music-playlists',
    'tags' => ['dynamic-programming', 'combinatorics', 'step-by-step'],
];
