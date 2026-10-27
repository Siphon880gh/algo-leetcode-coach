<?php
declare(strict_types=1);

return [
    'title' => 'Multi-Source Flood Fill',
    'leetcode' => 3905,
    'difficulty' => 'Med',
    'summary' => 'Multi-source BFS by time steps. Each round, every cell colored in the previous round offers its color to uncolored neighbours; a cell reached by several colors in the same round takes the maximum. Repeat until nothing changes.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'multi-source-flood-fill',
    'related_session' => 'multi-source-flood-fill',
];
