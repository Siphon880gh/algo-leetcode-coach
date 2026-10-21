<?php
declare(strict_types=1);

return [
    'title' => 'Page Recommendations II: friends\' likes minus your own',
    'leetcode' => 1892,
    'difficulty' => 'Hard',
    'summary' => 'Make friendships symmetric with UNION ALL, join each friend\'s likes, drop pages the user already likes (NOT EXISTS or an anti-join), then GROUP BY user and page with COUNT.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'joins', 'leetcode'],
    'related_session' => 'page-recommendations-ii',
];
