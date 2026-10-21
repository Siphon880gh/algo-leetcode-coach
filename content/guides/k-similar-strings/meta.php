<?php
declare(strict_types=1);

return [
    'title' => 'K-Similar Strings: BFS where each edge is a useful swap',
    'leetcode' => 854,
    'difficulty' => 'Hard',
    'summary' => 'BFS from s; the level where goal appears is the answer. Fix the first mismatch i and only swap it with a j > i that holds goal[i] and is itself wrong, which keeps the branching small.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['bfs', 'strings', 'graphs', 'leetcode'],
    'related_session' => 'k-similar-strings',
];
