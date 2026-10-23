<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Finish the Race: best stint, then split laps',
    'leetcode' => 2188,
    'difficulty' => 'Hard',
    'summary' => 'best[k] = fastest k laps on one tire without changing (stop growing once a lap costs more than changeTime + f). dp[i] = min over k of dp[i − k] + changeTime + best[k]; subtract one changeTime at the end.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-time-to-finish-the-race',
    'related_session' => 'minimum-time-to-finish-the-race',
];
