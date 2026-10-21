<?php
declare(strict_types=1);

return [
    'title' => 'Sequence Reconstruction: topological sort with exactly one choice each step',
    'leetcode' => 444,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: is nums the only shortest supersequence of every sequence? Each adjacent pair a, b is an edge a → b. Run Kahn’s topological sort; the order is unique only if the queue never holds more than one node. [1,2,3], [[1,2],[1,3]] → false. [[1,2],[1,3],[2,3]] → true. Not 210. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graphs', 'topological-sort', 'bfs', 'step-by-step'],
    'related_guide' => 'sequence-reconstruction',
];
