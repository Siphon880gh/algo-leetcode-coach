<?php
declare(strict_types=1);

return [
    'title' => 'Image Smoother: average the 3×3 inside the grid',
    'leetcode' => 661,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: for each cell, sum the in-bounds neighbors including itself, divide by how many there are, and floor. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'related_guide' => 'image-smoother',
    'tags' => ['matrix', 'arrays', 'simulation', 'step-by-step'],
];
