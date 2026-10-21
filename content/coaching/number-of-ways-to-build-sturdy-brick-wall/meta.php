<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Build Sturdy Brick Wall: compatible row masks',
    'leetcode' => 2184,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: rows depend on their neighbours, two rows fit when their inner-joint masks share nothing, and the wall ends are not joints. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-ways-to-build-sturdy-brick-wall',
    'tags' => ['array', 'dynamic-programming', 'bit-manipulation', 'bitmask', 'step-by-step'],
];
