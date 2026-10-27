<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Buy Apples II',
    'leetcode' => 3928,
    'difficulty' => 'Hard',
    'summary' => 'Going out empty uses road costs; coming back uses cost × tax. Run Dijkstra on both metrics from every shop j; then ans[i] = min over j of empty(i, j) + prices[j] + taxed(j, i).',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-buy-apples-ii',
    'related_session' => 'minimum-cost-to-buy-apples-ii',
];
