<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Vacation Days',
    'leetcode' => 568,
    'difficulty' => 'Hard',
    'summary' => 'dp[c] = best total ending week w in city c = days[c][w] + max dp over cities that can fly to c (or stay). Start in city 0; week 0 may begin anywhere reachable from it.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-vacation-days',
    'related_session' => 'maximum-vacation-days',
];
