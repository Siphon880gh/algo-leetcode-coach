<?php
declare(strict_types=1);

return [
    'title' => 'Dynamic Unpivoting of a Table: one SELECT per store column',
    'leetcode' => 2253,
    'difficulty' => 'Hard',
    'summary' => 'Read the store column names from the schema, generate one SELECT product_id, name, column … WHERE column IS NOT NULL per store, join them with UNION ALL, and execute the result as a prepared statement.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'dynamic-unpivoting-of-a-table',
];
