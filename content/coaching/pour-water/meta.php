<?php
declare(strict_types=1);

return [
    'title' => 'Pour Water: left first, nearest low wins',
    'leetcode' => 755,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: scan left while not going uphill, remember the nearest strictly lower spot, else try right, else stay. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'related_guide' => 'pour-water',
    'tags' => ['simulation', 'arrays', 'step-by-step'],
];
