<?php
declare(strict_types=1);

return [
    'title' => 'Pancake Sorting: top, then into place',
    'leetcode' => 969,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each size from n down to 2, flip the largest unsorted pancake to the top, then flip it into place, skipping flips that do nothing. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'pancake-sorting',
    'tags' => ['greedy', 'sorting', 'arrays', 'step-by-step'],
];
