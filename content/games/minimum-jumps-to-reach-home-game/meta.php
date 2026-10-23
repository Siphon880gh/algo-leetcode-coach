<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Jumps to Reach Home',
    'leetcode' => 1654,
    'difficulty' => 'Med',
    'summary' => 'BFS over (position, whether the last jump was backward). Forward a always; backward b only if the last jump was forward. Bound positions at max(x, forbidden) + a + b.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-jumps-to-reach-home',
    'related_session' => 'minimum-jumps-to-reach-home',
];
