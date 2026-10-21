<?php
declare(strict_types=1);

return [
    'title' => 'Valid Arrangement of Pairs: Eulerian path with Hierholzer',
    'leetcode' => 2097,
    'difficulty' => 'Hard',
    'summary' => 'Treat each pair as a directed edge. Start where out-degree exceeds in-degree by one (or anywhere if balanced), run Hierholzer\'s algorithm, and read consecutive vertices of the path as the pairs.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'eulerian-path', 'dfs', 'leetcode'],
    'related_session' => 'valid-arrangement-of-pairs',
];
