<?php
declare(strict_types=1);

return [
    'title' => 'Rearrange Products Table: UNION ALL per store',
    'leetcode' => 1795,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: one SELECT per store column with a literal store name, filter NULL prices, combine with UNION ALL. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'rearrange-products-table',
    'tags' => ['sql', 'union', 'step-by-step'],
];
