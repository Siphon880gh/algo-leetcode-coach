<?php
declare(strict_types=1);

return [
    'title' => 'Delete Columns to Make Sorted II: settle row pairs',
    'leetcode' => 955,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track which adjacent rows are already strictly ordered; delete a column if it breaks an unsettled pair, else keep it and settle the pairs it orders. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'delete-columns-to-make-sorted-ii',
    'tags' => ['greedy', 'strings', 'arrays', 'step-by-step'],
];
