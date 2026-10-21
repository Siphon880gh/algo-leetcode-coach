<?php
declare(strict_types=1);

return [
    'title' => 'Tournament Winners: unpivot, total, rank',
    'leetcode' => 1194,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: turn each match into two (player, points) rows, total them per player, join groups, and keep the first row per group by points descending and the tie-break. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'tournament-winners',
    'tags' => ['database', 'sql', 'window-functions', 'step-by-step'],
];
