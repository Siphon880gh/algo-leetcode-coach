<?php
declare(strict_types=1);

return [
    'title' => 'Design SQL: per-table counters and row maps',
    'leetcode' => 2408,
    'difficulty' => 'Med',
    'summary' => 'Keep, for each table, its column count, the next id and a map from id to row. Inserting checks the table and the row length, removing deletes the id, selecting checks every index, and exporting lists the remaining rows in id order.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'string', 'design', 'leetcode'],
    'related_session' => 'design-sql',
];
