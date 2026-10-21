<?php
declare(strict_types=1);

return [
    'title' => 'Active Users: consecutive login days via date minus row number',
    'leetcode' => 1454,
    'difficulty' => 'Med',
    'summary' => 'Deduplicate (id, date), subtract a per-user ROW_NUMBER in days from each date, and group. Consecutive days share the same anchor date, so a group size ≥ the threshold means active.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'window-functions', 'leetcode'],
    'related_session' => 'active-users',
];
