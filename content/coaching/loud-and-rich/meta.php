<?php
declare(strict_types=1);

return [
    'title' => 'Loud and Rich: memoized DFS toward richer people',
    'leetcode' => 851,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: point edges from each person to those richer, let answer[x] be the quietest of x and answer[y] for richer y, and memoize. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'loud-and-rich',
    'tags' => ['graphs', 'depth-first-search', 'topological-sort', 'memoization', 'step-by-step'],
];
