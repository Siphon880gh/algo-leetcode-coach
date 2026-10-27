<?php
declare(strict_types=1);

return [
    'title' => 'Cheapest Flights Within K Stops',
    'leetcode' => 787,
    'difficulty' => 'Med',
    'summary' => 'Bellman-Ford limited to k + 1 rounds: each round relaxes every flight using a copy of the previous round\'s prices, so a path uses at most one more edge per round.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'cheapest-flights-within-k-stops',
    'related_session' => 'cheapest-flights-within-k-stops',
];
