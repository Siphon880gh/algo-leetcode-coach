<?php
declare(strict_types=1);

return [
    'title' => 'Design a Stack With Increment Operation: lazy increments',
    'leetcode' => 1381,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: record increments at index min(k, size) − 1, and on pop add that increment and pass it down to the element below. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-a-stack-with-increment-operation',
    'tags' => ['design', 'stack', 'step-by-step'],
];
