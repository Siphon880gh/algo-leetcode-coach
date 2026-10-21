<?php
declare(strict_types=1);

return [
    'title' => 'Running Total for Different Genders: windowed SUM',
    'leetcode' => 1308,
    'difficulty' => 'Med',
    'summary' => 'SUM(score_points) OVER (PARTITION BY gender ORDER BY day) gives the cumulative total per gender; order the output by gender, then day.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'window-functions', 'leetcode'],
    'related_session' => 'running-total-for-different-genders',
];
