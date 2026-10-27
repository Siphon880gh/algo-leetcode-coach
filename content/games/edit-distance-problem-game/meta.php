<?php
declare(strict_types=1);

return [
    'title' => 'Edit Distance',
    'summary' => 'dp[i][j] = fewest inserts, deletes or replaces to turn the first i letters of word1 into the first j letters of word2. If the letters match, dp[i][j] = dp[i − 1][j − 1]; otherwise 1 + min(delete dp[i − 1][j], insert dp[i][j − 1], replace dp[i − 1][j − 1]). Row 0 and column 0 count pure inserts or deletes.',
    'category' => 'Algorithms',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'Algorithms · Dynamic Programming',
    'tags' => ['dp', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'edit-distance-problem',
    'related_session' => 'edit-distance-problem',
];
