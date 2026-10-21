<?php
declare(strict_types=1);

return [
    'title' => 'Subrectangle Queries: direct writes or an update log',
    'leetcode' => 1476,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: either overwrite cells on update, or log updates and answer reads by scanning the log from newest to oldest. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'subrectangle-queries',
    'tags' => ['design', 'matrix', 'step-by-step'],
];
