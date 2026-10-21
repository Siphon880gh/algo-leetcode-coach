<?php
declare(strict_types=1);

return [
    'title' => 'Parallel Courses: topological levels',
    'leetcode' => 1136,
    'difficulty' => 'Med',
    'summary' => 'Run Kahn\'s algorithm level by level: each BFS layer of courses with no remaining prerequisites is one semester. If some courses never reach in-degree 0, there is a cycle.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graphs', 'topological-sort', 'bfs', 'leetcode'],
    'related_session' => 'parallel-courses',
];
