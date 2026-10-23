<?php
declare(strict_types=1);

return [
    'title' => 'Painting the Walls: the paid painter buys time',
    'leetcode' => 2742,
    'difficulty' => 'Hard',
    'summary' => 'While the paid painter spends time[i] on wall i, the free painter paints time[i] other walls. So paying for wall i covers time[i] + 1 walls. dp[j] = least cost to cover j walls (0/1 knapsack, capped at n).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'painting-the-walls',
    'related_session' => 'painting-the-walls',
];
