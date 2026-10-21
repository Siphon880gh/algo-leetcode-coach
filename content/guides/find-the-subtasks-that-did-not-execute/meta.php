<?php
declare(strict_types=1);

return [
    'title' => 'Find the Subtasks That Did Not Execute: generate ids, then anti-join',
    'leetcode' => 1767,
    'difficulty' => 'Hard',
    'summary' => 'Generate every (task, subtask) pair with a recursive CTE counting up to the subtask count, then LEFT JOIN the executed pairs and keep the unmatched rows.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'recursive-cte', 'leetcode'],
    'related_session' => 'find-the-subtasks-that-did-not-execute',
];
