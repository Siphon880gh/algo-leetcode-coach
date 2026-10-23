<?php
declare(strict_types=1);

return [
    'title' => 'Design Task Manager',
    'leetcode' => 3408,
    'difficulty' => 'Med',
    'summary' => 'Map taskId → (userId, priority) and a max-heap of (priority, taskId) with lazy deletion. execTop pops the highest priority (larger taskId on ties), removes it and returns its user (−1 if no tasks).',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'design-task-manager',
    'related_session' => 'design-task-manager',
];
