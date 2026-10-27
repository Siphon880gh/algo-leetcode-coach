<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Transform Binary String',
    'leetcode' => 3980,
    'difficulty' => 'Med',
    'summary' => 'Sweep left to right with a small DP: positions that must become 0 have to be cleared in adjacent "11" pairs, possibly after first setting a neighbour to 1 (and setting it back if it must end as 1). Track whether the previous position is still waiting to be paired.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-transform-binary-string',
    'related_session' => 'minimum-operations-to-transform-binary-string',
];
