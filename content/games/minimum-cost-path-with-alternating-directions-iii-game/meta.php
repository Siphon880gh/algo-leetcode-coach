<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Path With Alternating Directions III',
    'leetcode' => 4003,
    'difficulty' => 'Hard',
    'summary' => 'Each state is (cell, parity of the next action number). Moves and waits all cost something non-negative, so run Dijkstra on 2·m·n states: obey the parity rule for just the entrance cost, break it for entrance plus the current cell\'s penalty, or wait for the penalty and flip parity.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-path-with-alternating-directions-iii',
    'related_session' => 'minimum-cost-path-with-alternating-directions-iii',
];
