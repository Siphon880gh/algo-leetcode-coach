<?php
declare(strict_types=1);

return [
    'title' => 'Number of Visible People in a Queue: monotonic stack from the right',
    'leetcode' => 1944,
    'difficulty' => 'Hard',
    'summary' => 'Scan right to left with a decreasing stack of heights. Person i sees every shorter person they pop, plus the first taller person left on the stack (if any).',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['monotonic-stack', 'stack', 'array', 'leetcode'],
    'related_session' => 'number-of-visible-people-in-a-queue',
];
