<?php
declare(strict_types=1);

return [
    'title' => 'Maximum of Minimum Values in All Subarrays: widest windows',
    'leetcode' => 1950,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: monotonic stack for each element\'s widest window as minimum, record by width, then sweep a running max from wide to narrow. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'related_guide' => 'maximum-of-minimum-values-in-all-subarrays',
    'tags' => ['monotonic-stack', 'array', 'step-by-step'],
];
