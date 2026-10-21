<?php
declare(strict_types=1);

return [
    'title' => 'Average Selling Price: units-weighted average',
    'leetcode' => 1251,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: left join price periods to sales inside them, divide SUM(price · units) by SUM(units), round, and default to 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'average-selling-price',
    'tags' => ['database', 'sql', 'step-by-step'],
];
