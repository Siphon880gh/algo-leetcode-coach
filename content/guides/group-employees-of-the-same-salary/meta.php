<?php
declare(strict_types=1);

return [
    'title' => 'Group Employees of the Same Salary: shared salaries, dense rank',
    'leetcode' => 1875,
    'difficulty' => 'Med',
    'summary' => 'Find salaries that occur at least twice (GROUP BY … HAVING COUNT(*) ≥ 2), keep only employees with those salaries, then DENSE_RANK() by salary for the team id.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'window-functions', 'leetcode'],
    'related_session' => 'group-employees-of-the-same-salary',
];
