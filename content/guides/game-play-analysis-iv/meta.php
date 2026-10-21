<?php
declare(strict_types=1);

return [
    'title' => 'Game Play Analysis IV: players who came back the day after their first login',
    'leetcode' => 550,
    'difficulty' => 'Med',
    'summary' => 'Fraction of players who logged in again on the day right after their first login, rounded to 2 decimals. Get each player\'s first date, LEFT JOIN Activity on the same player and first date + 1, and average whether a match exists. Sample → 0.33.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'join', 'aggregation', 'leetcode'],
    'related_session' => 'game-play-analysis-iv',
];
