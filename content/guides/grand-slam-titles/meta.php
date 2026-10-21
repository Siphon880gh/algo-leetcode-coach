<?php
declare(strict_types=1);

return [
    'title' => 'Grand Slam Titles: unpivot the tournament columns',
    'leetcode' => 1783,
    'difficulty' => 'Med',
    'summary' => 'Turn the per-tournament columns into rows with UNION ALL, join to players on the winner id, and GROUP BY the player to count titles.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'union', 'group-by', 'leetcode'],
    'related_session' => 'grand-slam-titles',
];
