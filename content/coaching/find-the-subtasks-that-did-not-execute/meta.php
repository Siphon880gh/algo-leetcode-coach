<?php
declare(strict_types=1);

return [
    'title' => 'Find the Subtasks That Did Not Execute: generate ids, then anti-join',
    'leetcode' => 1767,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: generate every (task, subtask) pair with a recursive CTE up to each task\'s count, then LEFT JOIN the executed pairs and keep the unmatched. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'find-the-subtasks-that-did-not-execute',
    'tags' => ['sql', 'recursive-cte', 'step-by-step'],
];
