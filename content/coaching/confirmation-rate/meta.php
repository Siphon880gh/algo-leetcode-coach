<?php
declare(strict_types=1);

return [
    'title' => 'Confirmation Rate: left join and average',
    'leetcode' => 1934,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: start from Signups, LEFT JOIN Confirmations, average the confirmed flag with NULL → 0, round to 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'confirmation-rate',
    'tags' => ['sql', 'database', 'joins', 'step-by-step'],
];
