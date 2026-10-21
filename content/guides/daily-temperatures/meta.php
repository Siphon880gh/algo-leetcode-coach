<?php
declare(strict_types=1);

return [
    'title' => 'Daily Temperatures: a stack of days still waiting',
    'leetcode' => 739,
    'difficulty' => 'Med',
    'summary' => 'Keep a stack of indexes whose warmer day has not arrived, with temperatures decreasing from bottom to top. Each new day pops every colder day and fills in its wait.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['monotonic-stack', 'stack', 'arrays', 'leetcode'],
    'related_session' => 'daily-temperatures',
];
