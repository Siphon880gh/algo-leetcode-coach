<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Jumps to Reach Home: BFS with a backward flag',
    'leetcode' => 1654,
    'difficulty' => 'Med',
    'summary' => 'BFS over (position, last move was backward). Forward by a always; backward by b only if the previous move was forward; skip forbidden and negative positions; cap positions at a safe bound.',
    'category' => 'LeetCode',
    'subcategory' => 'Breadth-First Search',
    'topic' => 'LeetCode · Breadth-First Search',
    'kind' => 'algo',
    'tags' => ['breadth-first-search', 'graph', 'leetcode'],
    'related_session' => 'minimum-jumps-to-reach-home',
];
