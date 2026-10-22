<?php
declare(strict_types=1);

return [
    'title' => 'Employees With Deductions: left join the logged time',
    'leetcode' => 2394,
    'difficulty' => 'Med',
    'summary' => 'Sum each employee’s session lengths, rounded as the statement says, in a subquery. Left join it to the employees so those with no sessions get 0, and keep employees whose total is below their requirement.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'employees-with-deductions',
];
