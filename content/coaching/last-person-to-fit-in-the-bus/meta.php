<?php
declare(strict_types=1);

return [
    'title' => 'Last Person to Fit in the Bus: running total by turn',
    'leetcode' => 1204,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: compute SUM(weight) OVER (ORDER BY turn), keep totals at most 1000, and return the name with the largest turn. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'last-person-to-fit-in-the-bus',
    'tags' => ['database', 'sql', 'window-functions', 'step-by-step'],
];
