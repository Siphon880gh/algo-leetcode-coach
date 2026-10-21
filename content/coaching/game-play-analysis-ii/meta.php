<?php
declare(strict_types=1);

return [
    'title' => 'Game Play Analysis II: match each player\'s first date back to its row',
    'leetcode' => 512,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: the device of each player\'s first login. Find (player_id, MIN(event_date)), then keep rows whose (player_id, event_date) match. Or RANK() per player by date, keep 1. Sample → 1: 2, 2: 3, 3: 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'tags' => ['database', 'sql', 'window-functions', 'step-by-step'],
    'related_guide' => 'game-play-analysis-ii',
];
