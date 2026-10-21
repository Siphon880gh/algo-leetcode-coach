<?php
declare(strict_types=1);

return [
    'title' => 'Rotating the Box: slide stones, then rotate',
    'leetcode' => 1861,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: per row, scan right to left moving stones to the lowest free slot, resetting at obstacles; then rotate clockwise. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'related_guide' => 'rotating-the-box',
    'tags' => ['matrix', 'two-pointers', 'simulation', 'step-by-step'],
];
