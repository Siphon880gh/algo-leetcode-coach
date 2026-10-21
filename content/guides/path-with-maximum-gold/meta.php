<?php
declare(strict_types=1);

return [
    'title' => 'Path with Maximum Gold: backtracking from every cell',
    'leetcode' => 1219,
    'difficulty' => 'Med',
    'summary' => 'Start a DFS from each cell with gold. Collect the cell, temporarily set it to 0 so the path cannot revisit it, try the four neighbours, then restore it; keep the best total.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'dfs', 'matrix', 'leetcode'],
    'related_session' => 'path-with-maximum-gold',
];
