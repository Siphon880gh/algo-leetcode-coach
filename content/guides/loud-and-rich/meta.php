<?php
declare(strict_types=1);

return [
    'title' => 'Loud and Rich: memoized DFS toward richer people',
    'leetcode' => 851,
    'difficulty' => 'Med',
    'summary' => 'Point an edge from each person to everyone directly richer. answer[x] is the quietest among x and answer[y] for every richer neighbor y; memoize it so each person is solved once.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'depth-first-search', 'topological-sort', 'memoization', 'leetcode'],
    'related_session' => 'loud-and-rich',
];
