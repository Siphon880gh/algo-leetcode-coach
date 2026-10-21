<?php
declare(strict_types=1);

return [
    'title' => 'Game Play Analysis III: running total with SUM() OVER',
    'leetcode' => 534,
    'difficulty' => 'Med',
    'summary' => 'For each player and date, report the games played so far. A window sum partitioned by player and ordered by date gives the running total: SUM(games_played) OVER (PARTITION BY player_id ORDER BY event_date). Or self-join on earlier dates and group.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'window-functions', 'leetcode'],
    'related_session' => 'game-play-analysis-iii',
];
