<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Score of a Path Between Two Cities: only 1’s component, detours allowed',
    'leetcode' => 2492,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: look only at roads in city 1’s component, and remember that roads may be reused, so any of them can be reached. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'minimum-score-of-a-path-between-two-cities',
    'tags' => ['depth-first-search', 'breadth-first-search', 'union-find', 'graph', 'step-by-step'],
];
