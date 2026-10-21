<?php
declare(strict_types=1);

return [
    'title' => 'Number of Distinct Islands II: a canonical form over 8 transforms',
    'leetcode' => 711,
    'difficulty' => 'Hard',
    'summary' => 'Collect each island\'s cells, apply all 8 rotations and reflections, normalize each by sorting and shifting to the origin, and keep the smallest as the island\'s key. Count the distinct keys.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'dfs', 'hash-set', 'geometry', 'matrix', 'leetcode'],
    'related_session' => 'number-of-distinct-islands-ii',
];
