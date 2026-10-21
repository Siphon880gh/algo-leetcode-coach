<?php
declare(strict_types=1);

return [
    'title' => 'Game Play Analysis I: GROUP BY player, MIN(event_date)',
    'leetcode' => 511,
    'difficulty' => 'Easy',
    'summary' => 'Return each player\'s first login date from Activity. Group rows by player_id and take MIN(event_date) AS first_login. Pandas: groupby("player_id").agg(first_login=("event_date", "min")). Sample → 1: 2016-03-01, 2: 2017-06-25, 3: 2016-03-02.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'aggregation', 'leetcode'],
    'related_session' => 'game-play-analysis-i',
];
