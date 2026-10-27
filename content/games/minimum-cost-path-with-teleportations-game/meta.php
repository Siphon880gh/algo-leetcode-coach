<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Path with Teleportations',
    'leetcode' => 3651,
    'difficulty' => 'Hard',
    'summary' => 'Layer by teleports used. Layer 0 is the usual right/down path DP. For layer t, a cell can be reached for free from any cell with a value ≥ its own, costing the best layer t−1 cost among those; then rerun the right/down DP on top.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-path-with-teleportations',
    'related_session' => 'minimum-cost-path-with-teleportations',
];
