<?php
declare(strict_types=1);

return [
    'title' => 'Clumsy Factorial: evaluate with a stack',
    'leetcode' => 1006,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: cycle through *, /, +, −, push for + and −, combine with the top for * and /, and sum the stack. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'clumsy-factorial',
    'tags' => ['stack', 'math', 'simulation', 'step-by-step'],
];
