<?php
declare(strict_types=1);

return [
    'title' => 'Find the Quiet Students in All Exams: exclude extremes',
    'leetcode' => 1412,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: rank scores per exam both ways with window functions, mark students ever at rank 1 either way, and return exam takers who are never marked. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'find-the-quiet-students-in-all-exams',
    'tags' => ['sql', 'window-functions', 'step-by-step'],
];
