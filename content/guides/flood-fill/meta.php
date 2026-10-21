<?php
declare(strict_types=1);

return [
    'title' => 'Flood Fill: recolor the connected region',
    'leetcode' => 733,
    'difficulty' => 'Easy',
    'summary' => 'Remember the starting cell\'s color. If it already equals the new color, return the image. Otherwise DFS or BFS through 4-connected cells of the original color, recoloring each one.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'dfs', 'bfs', 'matrix', 'leetcode'],
    'related_session' => 'flood-fill',
];
