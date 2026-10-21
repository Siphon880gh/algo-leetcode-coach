<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Area Rectangle: diagonal pairs',
    'leetcode' => 939,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: store the points in a set, treat each pair with different x and y as a diagonal, and check the other two corners. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'minimum-area-rectangle',
    'tags' => ['hash-table', 'geometry', 'math', 'step-by-step'],
];
