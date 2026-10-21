<?php
declare(strict_types=1);

return [
    'title' => 'Solve the Equation: reduce to (a − c)x = d − b',
    'leetcode' => 640,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: parse each side into an x coefficient and a constant, read bare x as 1, and handle a zero coefficient as infinite or no solutions. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'solve-the-equation',
    'tags' => ['math', 'strings', 'parsing', 'step-by-step'],
];
