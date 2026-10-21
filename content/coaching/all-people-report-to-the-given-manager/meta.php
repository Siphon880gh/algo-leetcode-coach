<?php
declare(strict_types=1);

return [
    'title' => 'All People Report to the Given Manager: chain self-joins',
    'leetcode' => 1270,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: join the table to itself once per level up the chain, keep rows whose top manager is the head, and exclude the head. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'all-people-report-to-the-given-manager',
    'tags' => ['database', 'sql', 'self-join', 'step-by-step'],
];
