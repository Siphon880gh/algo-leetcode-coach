<?php
declare(strict_types=1);

return [
    'title' => 'Dynamic Pivoting of a Table: build the column list, then run it',
    'leetcode' => 2252,
    'difficulty' => 'Hard',
    'summary' => 'Read the distinct store names in order, build one MAX(CASE WHEN store = name THEN price END) expression per store with GROUP_CONCAT, and execute the generated GROUP BY product_id query as a prepared statement.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'dynamic-pivoting-of-a-table',
];
