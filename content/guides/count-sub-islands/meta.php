<?php
declare(strict_types=1);

return [
    'title' => 'Count Sub-Islands: flood each grid2 island and check grid1',
    'leetcode' => 1905,
    'difficulty' => 'Med',
    'summary' => 'Flood-fill each island of grid2. It is a sub-island iff every one of its cells is land in grid1. Finish the whole flood even after a failure so the island is fully consumed.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['dfs', 'bfs', 'matrix', 'union-find', 'leetcode'],
    'related_session' => 'count-sub-islands',
];
