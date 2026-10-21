<?php
declare(strict_types=1);

return [
    'title' => 'Image Overlap: vote for shift vectors',
    'leetcode' => 835,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: every pair of a 1 in img1 and a 1 in img2 votes for the shift that would overlap them; the largest vote count is the answer. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Map',
    'topic' => 'LeetCode · Hash Map',
    'related_guide' => 'image-overlap',
    'tags' => ['hash-map', 'matrix', 'arrays', 'step-by-step'],
];
