<?php
declare(strict_types=1);

return [
    'title' => 'Validate Stack Sequences: pop as soon as you can',
    'leetcode' => 946,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: push each value, then pop while the top matches the next value in popped; the sequences are valid if every value gets popped. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'validate-stack-sequences',
    'tags' => ['stack', 'simulation', 'arrays', 'step-by-step'],
];
