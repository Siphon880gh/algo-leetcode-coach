<?php
declare(strict_types=1);

return [
    'title' => 'Web Crawler: same-host BFS',
    'leetcode' => 1236,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: extract the start hostname, BFS with a visited set, and only enqueue links on that hostname. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'web-crawler',
    'tags' => ['bfs', 'graphs', 'strings', 'step-by-step'],
];
