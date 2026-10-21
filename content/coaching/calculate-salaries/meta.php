<?php
declare(strict_types=1);

return [
    'title' => 'Calculate Salaries: rate from the company max',
    'leetcode' => 1468,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: compute MAX(salary) per company, map it to a rate with CASE, and apply it to each row with the required rounding. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'calculate-salaries',
    'tags' => ['sql', 'database', 'window-functions', 'step-by-step'],
];
