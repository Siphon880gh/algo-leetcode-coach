<?php
declare(strict_types=1);

return [
    'title' => 'Delete-Only Edit Distance',
    'summary' => 'Only deletes are allowed, from either string, until the two strings are equal. dp[i][j] for prefixes: equal last letters copy dp[i − 1][j − 1]; otherwise 1 + min(dp[i − 1][j], dp[i][j − 1]). Row 0 and column 0 delete everything. The answer is also len(a) + len(b) − 2 times LCS.',
    'category' => 'Algorithms',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'Algorithms · Dynamic Programming',
    'tags' => ['dp', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'labu-topic-801055041d9b',
    'related_session' => 'labu-topic-801055041d9b',
];
