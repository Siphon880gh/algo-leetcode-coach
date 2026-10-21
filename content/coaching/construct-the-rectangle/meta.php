<?php
declare(strict_types=1);

return [
    'title' => 'Construct the Rectangle: largest width at most sqrt(area) that divides it',
    'leetcode' => 492,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: [L, W] with L × W = area, L ≥ W, smallest L − W. Start W at floor(sqrt(area)) and step down until W divides area; L = area / W. 4 → [2,2]. 37 → [37,1]. 122122 → [427,286]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'step-by-step'],
    'related_guide' => 'construct-the-rectangle',
];
