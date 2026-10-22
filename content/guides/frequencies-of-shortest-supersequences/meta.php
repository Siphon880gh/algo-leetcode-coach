<?php
declare(strict_types=1);

return [
    'title' => 'Frequencies of Shortest Supersequences: double a set of letters, keep the rest acyclic',
    'leetcode' => 3435,
    'difficulty' => 'Hard',
    'summary' => 'Some shortest supersequence uses each letter once or twice. A letter used twice can come first and last, so it satisfies every word it is in. Try every subset of doubled letters: valid when every aa word’s letter is doubled and the edges among single letters have no cycle. Keep the valid subsets of the smallest size.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'graph', 'topological-sort', 'array', 'string', 'enumeration', 'leetcode'],
    'related_session' => 'frequencies-of-shortest-supersequences',
];
