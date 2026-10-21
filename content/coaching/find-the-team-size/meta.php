<?php
declare(strict_types=1);

return [
    'title' => 'Find the Team Size: COUNT over the team',
    'leetcode' => 1303,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: attach the team size to each row with COUNT(*) OVER (PARTITION BY team_id), or join each employee to a grouped count. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'find-the-team-size',
    'tags' => ['sql', 'window-functions', 'step-by-step'],
];
