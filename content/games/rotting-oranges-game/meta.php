<?php
declare(strict_types=1);

return [
    'title' => 'Rotting Oranges: every rotten orange spreads at once',
    'leetcode' => 994,
    'difficulty' => 'Med',
    'summary' => 'Multi-source BFS. Put every rotten orange in the queue at minute 0. Each minute, every fresh orange next to a rotten one rots. If any fresh orange is never reached, the answer is −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'rotting-oranges',
    'related_session' => 'rotting-oranges',
];
