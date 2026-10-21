<?php
declare(strict_types=1);

return [
    'title' => 'Find Followers Count: group and count',
    'leetcode' => 1729,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: GROUP BY user_id, COUNT(follower_id) AS followers_count, ORDER BY user_id. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'find-followers-count',
    'tags' => ['sql', 'database', 'step-by-step'],
];
