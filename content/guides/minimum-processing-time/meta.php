<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Processing Time: earliest processor gets the longest tasks',
    'leetcode' => 2895,
    'difficulty' => 'Med',
    'summary' => 'Sort processors ascending and tasks descending. Processor i takes tasks 4i … 4i + 3, so its finish time is p[i] + tasks[4i].',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'sorting', 'leetcode'],
    'related_session' => 'minimum-processing-time',
];
