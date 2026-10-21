<?php
declare(strict_types=1);

return [
    'title' => 'Sequence Reconstruction: topological sort with exactly one choice each step',
    'leetcode' => 444,
    'difficulty' => 'Med',
    'summary' => 'nums is a permutation of 1..n. Is it the only shortest supersequence of every sequences[i]? Add an edge for each adjacent pair, then run Kahn’s topological sort. Unique order ⇔ the queue never holds more than one node. [1,2,3], [[1,2],[1,3]] → false. [[1,2],[1,3],[2,3]] → true. Not 210.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'topological-sort', 'bfs', 'leetcode'],
    'related_session' => 'sequence-reconstruction',
];
