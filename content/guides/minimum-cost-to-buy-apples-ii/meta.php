<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Buy Apples II: Dijkstra on two layers',
    'leetcode' => 3928,
    'difficulty' => 'Hard',
    'summary' => 'Layer 0 is traveling empty (cost), layer 1 is carrying (cost · tax), and buying at shop j moves you from layer 0 to layer 1 for prices[j]. ans[i] is the shortest path from (i, empty) to (i, carrying).',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'array', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'minimum-cost-to-buy-apples-ii',
];
