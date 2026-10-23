<?php
declare(strict_types=1);

return [
    'title' => 'Most Profitable Path in a Tree',
    'leetcode' => 2467,
    'difficulty' => 'Med',
    'summary' => 'First find Bob\'s path to 0 and the time he reaches each node on it. Then DFS Alice from 0: at time t she gets the full amount if she arrives before Bob, half if together, nothing after. Best leaf total.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'most-profitable-path-in-a-tree',
    'related_session' => 'most-profitable-path-in-a-tree',
];
