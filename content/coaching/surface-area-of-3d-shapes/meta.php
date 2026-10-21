<?php
declare(strict_types=1);

return [
    'title' => 'Surface Area of 3D Shapes: towers minus shared walls',
    'leetcode' => 892,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: a tower of height v alone has 4v + 2 faces; subtract 2 · min(v, w) for each touching pair, checking only right and down neighbors. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'related_guide' => 'surface-area-of-3d-shapes',
    'tags' => ['matrix', 'math', 'geometry', 'step-by-step'],
];
