<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Points Tourist Can Earn: stay or travel each day',
    'leetcode' => 3332,
    'difficulty' => 'Med',
    'summary' => 'dp[c] = best points ending day i in city c = max(prev[c] + stayScore[i][c], max over p ≠ c of prev[p] + travelScore[p][c]). Start anywhere with 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-points-tourist-can-earn',
    'related_session' => 'maximum-points-tourist-can-earn',
];
