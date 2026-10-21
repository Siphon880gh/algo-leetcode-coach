<?php
declare(strict_types=1);

return [
    'title' => 'Path with Maximum Probability: max-heap Dijkstra',
    'leetcode' => 1514,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: best[start] = 1; pop the highest probability; relax neighbours by multiplication; return when end pops, else 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'path-with-maximum-probability',
    'tags' => ['graph', 'dijkstra', 'heap', 'step-by-step'],
];
