<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Coin Collection',
    'leetcode' => 3466,
    'difficulty' => 'Med',
    'summary' => 'dp[s] = best coins for a trip ending at the current mile having made s switches (lane = s even ? 1 : 2). Each mile: dp[s] = coin(lane(s)) + max(0 [enter here], dp[s], dp[s−1]). Track the best value seen.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-coin-collection',
    'related_session' => 'maximum-coin-collection',
];
