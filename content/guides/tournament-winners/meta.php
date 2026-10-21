<?php
declare(strict_types=1);

return [
    'title' => 'Tournament Winners: total points per group',
    'leetcode' => 1194,
    'difficulty' => 'Hard',
    'summary' => 'Stack both sides of each match into (player, points) rows, total them per player, join groups, and rank within each group by points descending then id ascending.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'window-functions', 'leetcode'],
    'related_session' => 'tournament-winners',
];
