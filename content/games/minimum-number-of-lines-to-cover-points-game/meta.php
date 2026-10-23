<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Lines to Cover Points: bitmask over covered points',
    'leetcode' => 2152,
    'difficulty' => 'Med',
    'summary' => 'Each pair of points defines a line covering every collinear point (a mask). dp[mask] = fewest lines to cover mask: take the lowest uncovered point and either draw a line through it and another point, or give it its own line.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-lines-to-cover-points',
    'related_session' => 'minimum-number-of-lines-to-cover-points',
];
