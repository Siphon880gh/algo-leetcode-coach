<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Reach Target With Limited Power: Dijkstra on (node, power)',
    'leetcode' => 3977,
    'difficulty' => 'Hard',
    'summary' => 'Power is at most 1000, so the state is (node, power left). Pop states by time, then by more power; the first time target is popped gives both answers.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'array', 'dynamic-programming', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'minimum-time-to-reach-target-with-limited-power',
];
