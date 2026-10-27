<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Threshold Path With Limited Heavy Edges',
    'leetcode' => 3924,
    'difficulty' => 'Hard',
    'summary' => 'A larger threshold only turns heavy edges light, so binary search it over {0} ∪ edge weights. For a candidate, 0-1 BFS where heavy edges cost 1 gives the fewest heavy edges from source to target; it works if that is at most k.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-threshold-path-with-limited-heavy-edges',
    'related_session' => 'minimum-threshold-path-with-limited-heavy-edges',
];
