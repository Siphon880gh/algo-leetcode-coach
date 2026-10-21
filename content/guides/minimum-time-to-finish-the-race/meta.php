<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Finish the Race: best stint per length',
    'leetcode' => 2188,
    'difficulty' => 'Hard',
    'summary' => 'best[x] = fastest x consecutive laps on one tire, only for x while a lap stays at most changeTime + f (about 18 laps). Then dp[i] = min over x of best[x] + changeTime + dp[i − x], subtracting one changeTime at the end.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-time-to-finish-the-race',
];
