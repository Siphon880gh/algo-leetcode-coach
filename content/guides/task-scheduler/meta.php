<?php
declare(strict_types=1);

return [
    'title' => 'Task Scheduler: frames built around the most frequent task',
    'leetcode' => 621,
    'difficulty' => 'Med',
    'summary' => 'The most frequent task sets the frame: (maxCount − 1) blocks of length n + 1, plus one slot per task tied for the max. The answer is that, or the number of tasks if that is larger.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'counting', 'arrays', 'heap', 'leetcode'],
    'related_session' => 'task-scheduler',
];
