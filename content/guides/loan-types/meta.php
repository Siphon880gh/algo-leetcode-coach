<?php
declare(strict_types=1);

return [
    'title' => 'Loan Types: both types per user',
    'leetcode' => 2990,
    'difficulty' => 'Easy',
    'summary' => 'Group by user and require both types with HAVING SUM(type = first) > 0 AND SUM(type = second) > 0.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'loan-types',
];
