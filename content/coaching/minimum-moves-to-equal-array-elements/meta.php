<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Equal Array Elements: raising n − 1 is lowering one',
    'leetcode' => 453,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: one move adds 1 to n − 1 elements. That equals subtracting 1 from one element, so everything comes down to the minimum: answer = sum − min × n. [1,2,3] → 3. [1,1,1] → 0. Not 462. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'arrays', 'step-by-step'],
    'related_guide' => 'minimum-moves-to-equal-array-elements',
];
