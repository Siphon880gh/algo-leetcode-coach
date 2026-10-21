<?php
declare(strict_types=1);

return [
    'title' => 'Friend Requests II: count both sides of each friendship',
    'leetcode' => 602,
    'difficulty' => 'Med',
    'summary' => 'A friendship counts for both people, so stack requester_id and accepter_id with UNION ALL, count per id, and take the top.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'union', 'group-by', 'leetcode'],
    'related_session' => 'friend-requests-ii-who-has-the-most-friends',
];
