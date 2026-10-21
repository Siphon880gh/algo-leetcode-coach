<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Knight Moves: BFS in one quadrant',
    'leetcode' => 1197,
    'difficulty' => 'Med',
    'summary' => 'By symmetry, solve for (|x|, |y|). Run BFS from the origin, allowing coordinates down to −2 so paths that dip briefly below an axis are still found, and stop when the target is reached.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['bfs', 'graphs', 'math', 'leetcode'],
    'related_session' => 'minimum-knight-moves',
];
