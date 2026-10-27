<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path With At Most K Consecutive Identical Characters',
    'leetcode' => 3970,
    'difficulty' => 'Med',
    'summary' => 'Run Dijkstra on states (node, current run length of its label). Moving to v keeps the run going (run + 1) if labels match, else resets it to 1; drop any move that pushes the run past k.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'shortest-path-with-at-most-k-consecutive-identical-characters',
    'related_session' => 'shortest-path-with-at-most-k-consecutive-identical-characters',
];
