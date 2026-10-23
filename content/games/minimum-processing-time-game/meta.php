<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Processing Time: longest tasks to earliest processors',
    'leetcode' => 2895,
    'difficulty' => 'Med',
    'summary' => 'Sort processors ascending and tasks descending. Processor i gets tasks 4i … 4i+3; its finish time is processorTime[i] + tasks[4i].',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-processing-time',
    'related_session' => 'minimum-processing-time',
];
