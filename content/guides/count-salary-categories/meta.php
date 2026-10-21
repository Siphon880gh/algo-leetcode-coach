<?php
declare(strict_types=1);

return [
    'title' => 'Count Salary Categories: one row per category, even when empty',
    'leetcode' => 1907,
    'difficulty' => 'Med',
    'summary' => 'All three categories must appear, including those with zero accounts. Build each category\'s row with a conditional SUM over the whole table and UNION ALL them; GROUP BY alone would drop empty categories.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'aggregation', 'leetcode'],
    'related_session' => 'count-salary-categories',
];
