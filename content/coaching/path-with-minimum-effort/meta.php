<?php
declare(strict_types=1);

return [
    'title' => 'Path With Minimum Effort: minimax Dijkstra',
    'leetcode' => 1631,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: Dijkstra where a path\'s cost is its largest step; relax with max(d, |Δh|); stop at the target. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'path-with-minimum-effort',
    'tags' => ['dijkstra', 'heap', 'binary-search', 'union-find', 'step-by-step'],
];
