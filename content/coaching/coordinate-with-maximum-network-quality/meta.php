<?php
declare(strict_types=1);

return [
    'title' => 'Coordinate With Max Network Quality: brute-force grid',
    'leetcode' => 1620,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: test every integer point in 0 … 50 squared, sum floor(q / (1 + d)) over reachable towers, keep the strictly best in lexicographic scan order. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Enumeration',
    'topic' => 'LeetCode · Enumeration',
    'related_guide' => 'coordinate-with-maximum-network-quality',
    'tags' => ['enumeration', 'geometry', 'step-by-step'],
];
