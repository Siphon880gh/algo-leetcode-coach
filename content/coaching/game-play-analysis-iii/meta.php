<?php
declare(strict_types=1);

return [
    'title' => 'Game Play Analysis III: running total with SUM() OVER',
    'leetcode' => 534,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: games played so far per player and date. SUM(games_played) OVER (PARTITION BY player_id ORDER BY event_date). Or self-join on earlier dates. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'tags' => ['database', 'sql', 'window-functions', 'step-by-step'],
    'related_guide' => 'game-play-analysis-iii',
];
