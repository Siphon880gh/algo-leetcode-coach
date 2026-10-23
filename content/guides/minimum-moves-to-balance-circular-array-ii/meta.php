<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Balance Circular Array II: min-cost flow around the circle',
    'leetcode' => 4004,
    'difficulty' => 'Hard',
    'summary' => 'Each unit moved one step costs 1. People with a surplus send units around the circle to people with a deficit, and nobody has to end at exactly 0. That is a min-cost flow: the source feeds surpluses, deficits drain to the sink, and every circle edge costs 1 in both directions.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'array', 'math', 'min-cost-flow', 'leetcode'],
    'related_session' => 'minimum-moves-to-balance-circular-array-ii',
];
