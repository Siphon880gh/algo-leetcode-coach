<?php
declare(strict_types=1);

return [
    'title' => 'Find the Safest Path in a Grid',
    'leetcode' => 2812,
    'difficulty' => 'Med',
    'summary' => 'Multi-source BFS from all thieves gives each cell\'s safeness. Then add cells from safest to least safe, unioning neighbors; when (0,0) and (n−1,n−1) connect, the current safeness is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-safest-path-in-a-grid',
    'related_session' => 'find-the-safest-path-in-a-grid',
];
