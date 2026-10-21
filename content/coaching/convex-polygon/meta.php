<?php
declare(strict_types=1);

return [
    'title' => 'Convex Polygon: every turn has the same cross-product sign',
    'leetcode' => 469,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: points in order form a simple polygon; is it convex? Every turn must bend the same way. For each vertex (with wraparound), take the cross product of consecutive edge vectors; skip zeros; a sign change means false. Square → true. Square plus an inner point → false. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'geometry', 'step-by-step'],
    'related_guide' => 'convex-polygon',
];
