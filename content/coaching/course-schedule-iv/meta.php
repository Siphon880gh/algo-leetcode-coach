<?php
declare(strict_types=1);

return [
    'title' => 'Course Schedule IV: precompute reachability',
    'leetcode' => 1462,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: build reach[a][b] from prerequisites, close it with Floyd–Warshall (or BFS from each node), then answer queries in O(1). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'course-schedule-iv',
    'tags' => ['graph', 'topological-sort', 'step-by-step'],
];
