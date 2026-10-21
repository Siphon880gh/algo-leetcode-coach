<?php
declare(strict_types=1);

return [
    'title' => 'Parallel Courses: Kahn by levels',
    'leetcode' => 1136,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: compute in-degrees, take all zero in-degree courses as one semester, remove them, and repeat; check that every course was taken. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'parallel-courses',
    'tags' => ['graphs', 'topological-sort', 'bfs', 'step-by-step'],
];
