<?php
declare(strict_types=1);

return [
    'title' => 'Convex Polygon: every turn has the same cross-product sign',
    'leetcode' => 469,
    'difficulty' => 'Med',
    'summary' => 'Points form a simple polygon in order. It is convex exactly when every consecutive turn bends the same way. For each i, take the cross product of (p[i+1] − p[i]) and (p[i+2] − p[i]), wrapping around. Ignore zeros (collinear); if two nonzero signs differ, false. [[0,0],[0,5],[5,5],[5,0]] → true. Adding [5,5] inside → false.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'geometry', 'leetcode'],
    'related_session' => 'convex-polygon',
];
