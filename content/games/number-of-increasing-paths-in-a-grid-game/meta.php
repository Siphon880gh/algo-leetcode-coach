<?php
declare(strict_types=1);

return [
    'title' => 'Number of Increasing Paths in a Grid',
    'leetcode' => 2328,
    'difficulty' => 'Hard',
    'summary' => 'paths[cell] = 1 + the sum of paths[neighbor] over strictly larger neighbors. Memoized DFS (or process cells by decreasing value); sum all cells mod 1e9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-increasing-paths-in-a-grid',
    'related_session' => 'number-of-increasing-paths-in-a-grid',
];
