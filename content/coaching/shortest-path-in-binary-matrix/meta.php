<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path in Binary Matrix: eight-way BFS',
    'leetcode' => 1091,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: check both corners are clear, BFS from the top-left over eight neighbours, mark cells when pushed, and return the distance in cells at the bottom-right. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'shortest-path-in-binary-matrix',
    'tags' => ['graphs', 'bfs', 'matrix', 'step-by-step'],
];
