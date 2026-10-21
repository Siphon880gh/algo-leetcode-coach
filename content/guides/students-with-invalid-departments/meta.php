<?php
declare(strict_types=1);

return [
    'title' => 'Students With Invalid Departments: anti-join',
    'leetcode' => 1350,
    'difficulty' => 'Easy',
    'summary' => 'LEFT JOIN students to departments and keep rows where no department matched, or use NOT EXISTS / NOT IN against the department ids.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'join', 'leetcode'],
    'related_session' => 'students-with-invalid-departments',
];
