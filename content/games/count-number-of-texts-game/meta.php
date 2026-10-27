<?php
declare(strict_types=1);

return [
    'title' => 'Count Number of Texts: the last letter used 1 to 3 (or 4) presses',
    'leetcode' => 2266,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = messages for the first i presses. The last letter used k equal presses (k at most 3, or at most 4 for keys 7 and 9): dp[i] = the sum of dp[i − k].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-number-of-texts',
    'related_session' => 'count-number-of-texts',
];
