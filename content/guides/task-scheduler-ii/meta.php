<?php
declare(strict_types=1);

return [
    'title' => 'Task Scheduler II: jump to the earliest allowed day',
    'leetcode' => 2365,
    'difficulty' => 'Med',
    'summary' => 'Keep the last day each task type was done. Each task runs on the next day, or on last[type] + space + 1 if that is later, so breaks are skipped in one jump.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'simulation', 'leetcode'],
    'related_session' => 'task-scheduler-ii',
];
