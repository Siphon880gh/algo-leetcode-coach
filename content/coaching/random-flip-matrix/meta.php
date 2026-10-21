<?php
declare(strict_types=1);

return [
    'title' => 'Random Flip Matrix: virtual Fisher-Yates with a hash map',
    'leetcode' => 519,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: flip() picks a uniform random 0 cell of an m × n matrix (up to 1e8 cells) and sets it to 1; reset() clears. Virtual Fisher-Yates: draw r in [0, total − 1], answer map.get(r, r), move the last live index into r, total −= 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Randomized',
    'topic' => 'LeetCode · Randomized',
    'tags' => ['randomized', 'hash-table', 'design', 'step-by-step'],
    'related_guide' => 'random-flip-matrix',
];
