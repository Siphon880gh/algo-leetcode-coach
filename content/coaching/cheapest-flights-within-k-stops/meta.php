<?php
declare(strict_types=1);

return [
    'title' => 'Cheapest Flights Within K Stops: k + 1 relaxation rounds',
    'leetcode' => 787,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: k stops means k + 1 flights, so run that many Bellman-Ford rounds, each reading from the previous round\'s copy. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'cheapest-flights-within-k-stops',
    'tags' => ['graphs', 'shortest-path', 'bellman-ford', 'dynamic-programming', 'step-by-step'],
];
