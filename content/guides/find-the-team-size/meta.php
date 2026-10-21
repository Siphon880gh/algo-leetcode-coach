<?php
declare(strict_types=1);

return [
    'title' => 'Find the Team Size: count per team with a window',
    'leetcode' => 1303,
    'difficulty' => 'Easy',
    'summary' => 'COUNT(*) OVER (PARTITION BY team_id) attaches the team size to every row without collapsing it, or you can join the table to a grouped count of team sizes.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'window-functions', 'leetcode'],
    'related_session' => 'find-the-team-size',
];
