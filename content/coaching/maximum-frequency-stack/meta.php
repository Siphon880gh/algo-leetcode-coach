<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Frequency Stack: stacks by frequency level',
    'leetcode' => 895,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: keep each value\'s count and one stack per frequency; push onto the stack of the new count, pop from the highest non-empty stack. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'maximum-frequency-stack',
    'tags' => ['design', 'stack', 'hash-table', 'step-by-step'],
];
