<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Distance After Road Addition Queries II: skip covered cities',
    'leetcode' => 3244,
    'difficulty' => 'Hard',
    'summary' => 'Roads never cross, so a new road u → v either lies inside an existing shortcut or swallows the cities between u and v. Keep next pointers and delete swallowed cities; the answer is the number of live edges.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'graph', 'array', 'ordered-set', 'leetcode'],
    'related_session' => 'shortest-distance-after-road-addition-queries-ii',
];
