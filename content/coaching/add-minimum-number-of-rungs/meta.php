<?php
declare(strict_types=1);

return [
    'title' => 'Add Minimum Number of Rungs: per-gap formula',
    'leetcode' => 1936,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each gap from the previous height (start at 0), add (gap − 1) // dist. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'add-minimum-number-of-rungs',
    'tags' => ['greedy', 'array', 'step-by-step'],
];
