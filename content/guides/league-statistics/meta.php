<?php
declare(strict_types=1);

return [
    'title' => 'League Statistics: unpivot home and away',
    'leetcode' => 1841,
    'difficulty' => 'Med',
    'summary' => 'Stack each match twice (home view and away view) with UNION ALL, join teams, and aggregate counts, CASE-based points and goal sums per team.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'union', 'group-by', 'leetcode'],
    'related_session' => 'league-statistics',
];
