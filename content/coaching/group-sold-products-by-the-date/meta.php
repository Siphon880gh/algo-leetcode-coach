<?php
declare(strict_types=1);

return [
    'title' => 'Group Sold Products By The Date: distinct count and sorted concat',
    'leetcode' => 1484,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: GROUP BY sell_date; COUNT(DISTINCT product); GROUP_CONCAT(DISTINCT product ORDER BY product). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'group-sold-products-by-the-date',
    'tags' => ['sql', 'database', 'step-by-step'],
];
