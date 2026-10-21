<?php
declare(strict_types=1);

return [
    'title' => 'Making A Large Island: label islands, then try each water cell',
    'leetcode' => 827,
    'difficulty' => 'Hard',
    'summary' => 'Flood-fill every island with its own id and record its size. For each 0 cell, the new island is 1 plus the sizes of the distinct island ids around it. Take the maximum, and handle a grid with no water.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'dfs', 'bfs', 'union-find', 'matrix', 'leetcode'],
    'related_session' => 'making-a-large-island',
];
