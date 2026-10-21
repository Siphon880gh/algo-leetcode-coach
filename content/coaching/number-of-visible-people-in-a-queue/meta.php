<?php
declare(strict_types=1);

return [
    'title' => 'Number of Visible People in a Queue: decreasing stack from the right',
    'leetcode' => 1944,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: pop and count shorter people, then add one if a taller person remains; push yourself. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'related_guide' => 'number-of-visible-people-in-a-queue',
    'tags' => ['monotonic-stack', 'stack', 'array', 'step-by-step'],
];
