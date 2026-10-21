<?php
declare(strict_types=1);

return [
    'title' => 'RLE Iterator: consume counts in place',
    'leetcode' => 900,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a pointer to the current run, skip whole runs while they are too small, then subtract from the current run and return its value. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'rle-iterator',
    'tags' => ['design', 'arrays', 'step-by-step'],
];
