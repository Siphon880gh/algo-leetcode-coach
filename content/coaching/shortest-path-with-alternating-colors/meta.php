<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path with Alternating Colors: states with the last color',
    'leetcode' => 1129,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: BFS over (node, color of the last edge), starting from node 0 with both colors, and only follow edges of the other color. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'shortest-path-with-alternating-colors',
    'tags' => ['graphs', 'bfs', 'step-by-step'],
];
