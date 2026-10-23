<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Connect Two Groups: mask the right side',
    'leetcode' => 1595,
    'difficulty' => 'Hard',
    'summary' => 'f(i, mask) = cheapest way to connect left points i.. given right points in mask are already connected. Each left point picks one right point. At the end, every unconnected right point uses its cheapest edge.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-connect-two-groups-of-points',
    'related_session' => 'minimum-cost-to-connect-two-groups-of-points',
];
