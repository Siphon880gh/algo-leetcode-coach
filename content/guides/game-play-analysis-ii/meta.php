<?php
declare(strict_types=1);

return [
    'title' => 'Game Play Analysis II: match each player\'s first date back to its row',
    'leetcode' => 512,
    'difficulty' => 'Easy',
    'summary' => 'Report the device each player used at their first login. Find (player_id, MIN(event_date)) per player, then keep the Activity rows whose (player_id, event_date) is in that set. Or rank rows per player by event_date with a window and keep rank 1. Sample → 1: 2, 2: 3, 3: 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'window-functions', 'leetcode'],
    'related_session' => 'game-play-analysis-ii',
];
