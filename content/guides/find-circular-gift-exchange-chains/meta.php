<?php
declare(strict_types=1);

return [
    'title' => 'Find Circular Gift Exchange Chains: walk each loop with a recursive CTE',
    'leetcode' => 3401,
    'difficulty' => 'Hard',
    'summary' => 'From each giver, follow receivers with a recursive CTE, carrying the length, the running total and the smallest id seen. A walk that returns to its start is a loop; keep it once, from its smallest member.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'find-circular-gift-exchange-chains',
];
