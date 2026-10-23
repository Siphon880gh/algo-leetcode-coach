<?php
declare(strict_types=1);

return [
    'title' => 'All Paths From Source Lead to Destination',
    'leetcode' => 1059,
    'difficulty' => 'Med',
    'summary' => 'DFS with three colors. Reaching a dead end other than destination fails; reaching a gray (on-stack) node means a cycle, so infinitely many paths: fail. The destination must have no outgoing edges.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'all-paths-from-source-lead-to-destination',
    'related_session' => 'all-paths-from-source-lead-to-destination',
];
