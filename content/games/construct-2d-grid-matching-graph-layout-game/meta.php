<?php
declare(strict_types=1);

return [
    'title' => 'Construct 2D Grid Matching Graph Layout',
    'leetcode' => 3311,
    'difficulty' => 'Hard',
    'summary' => 'A degree-1 node means a single row: walk the path. Otherwise start at a corner (degree 2); the nearest other corner ends the first row along a unique shortest path. Each next row is the unique unused neighbor of each cell above.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'construct-2d-grid-matching-graph-layout',
    'related_session' => 'construct-2d-grid-matching-graph-layout',
];
