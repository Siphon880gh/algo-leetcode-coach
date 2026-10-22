<?php
declare(strict_types=1);

return [
    'title' => 'Design Task Manager: map plus a lazy max-heap',
    'leetcode' => 3408,
    'difficulty' => 'Med',
    'summary' => 'Store each task’s current (user, priority) in a map. Push (priority, taskId, user) into a max-heap on add and edit; on execTop, pop until the top matches the map, so removed and edited entries are skipped.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-table', 'ordered-set', 'heap', 'leetcode'],
    'related_session' => 'design-task-manager',
];
