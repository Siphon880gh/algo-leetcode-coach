<?php
declare(strict_types=1);

return [
    'title' => 'Redundant Connection II',
    'leetcode' => 685,
    'difficulty' => 'Hard',
    'summary' => 'If some node has two parents, the answer is one of those two edges (cand1 earlier, cand2 later). Union all edges except cand2: a cycle means cand1 (or the cycle edge if no node has two parents); no cycle means cand2.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'redundant-connection-ii',
    'related_session' => 'redundant-connection-ii',
];
