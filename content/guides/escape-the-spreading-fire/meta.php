<?php
declare(strict_types=1);

return [
    'title' => 'Escape the Spreading Fire: fire times, then binary search the wait',
    'leetcode' => 2258,
    'difficulty' => 'Hard',
    'summary' => 'BFS from all fires gives when each cell burns. A wait w works if a BFS starting at time w reaches each cell strictly before the fire, except the safehouse, which may be reached at the same minute. Binary search the largest w; return 10^9 if any wait works and −1 if none does.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'breadth-first-search', 'matrix', 'leetcode'],
    'related_session' => 'escape-the-spreading-fire',
];
