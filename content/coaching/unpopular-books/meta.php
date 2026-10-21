<?php
declare(strict_types=1);

return [
    'title' => 'Unpopular Books: filter orders in the join',
    'leetcode' => 1098,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep books that have been available long enough, left join only the past year\'s orders, and keep books whose summed quantity, with no orders as 0, is under the threshold. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'unpopular-books',
    'tags' => ['database', 'sql', 'step-by-step'],
];
