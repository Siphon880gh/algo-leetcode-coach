<?php
declare(strict_types=1);

return [
    'title' => 'Frog Position After t Seconds: split probability, stop at leaves',
    'leetcode' => 1377,
    'difficulty' => 'Hard',
    'summary' => 'DFS from vertex 1 multiplying by 1 divided by (unvisited children). At the target: if exactly t seconds passed, or the frog is stuck (no unvisited children) before t, return the probability; otherwise 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'frog-position-after-t-seconds',
    'related_session' => 'frog-position-after-t-seconds',
];
