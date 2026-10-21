<?php
declare(strict_types=1);

return [
    'title' => 'The Most Recent Three Orders: rank per customer',
    'leetcode' => 1532,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: ROW_NUMBER per customer by date descending, keep rn ≤ 3, join names, order as required. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'the-most-recent-three-orders',
    'tags' => ['sql', 'database', 'window-functions', 'step-by-step'],
];
