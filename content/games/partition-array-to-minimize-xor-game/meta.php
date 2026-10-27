<?php
declare(strict_types=1);

return [
    'title' => 'Partition Array to Minimize XOR',
    'leetcode' => 3599,
    'difficulty' => 'Med',
    'summary' => 'dp[j][i] = smallest possible max-XOR when the first i elements form j pieces: try every start p of the last piece, max(dp[j−1][p], xor(p to i−1)), using prefix XORs.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'partition-array-to-minimize-xor',
    'related_session' => 'partition-array-to-minimize-xor',
];
