<?php
declare(strict_types=1);

return [
    'title' => 'All Paths From Source Lead to Destination: DFS with three states',
    'leetcode' => 1059,
    'difficulty' => 'Med',
    'summary' => 'Search from source. A dead end must be the destination, and reaching a node that is still on the current path means a cycle, which allows infinite paths. Mark finished nodes as safe so each is explored once.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graphs', 'dfs', 'topological-sort', 'leetcode'],
    'related_session' => 'all-paths-from-source-lead-to-destination',
];
