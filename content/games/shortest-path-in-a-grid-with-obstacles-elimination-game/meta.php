<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path in a Grid with Obstacles Elimination',
    'leetcode' => 1293,
    'difficulty' => 'Hard',
    'summary' => 'BFS over states (row, col, eliminations left). Stepping onto an obstacle uses one elimination. Remember the best remaining k per cell to prune. First arrival at the corner is the shortest.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'shortest-path-in-a-grid-with-obstacles-elimination',
    'related_session' => 'shortest-path-in-a-grid-with-obstacles-elimination',
];
