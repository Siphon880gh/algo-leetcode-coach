<?php
declare(strict_types=1);

return [
    'title' => 'Possible Bipartition: two-color the dislikes',
    'leetcode' => 886,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each dislike is an edge that must cross groups, so try to two-color every component and fail on a same-color edge. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'possible-bipartition',
    'tags' => ['graphs', 'bfs', 'union-find', 'step-by-step'],
];
