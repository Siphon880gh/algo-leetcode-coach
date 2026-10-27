<?php
declare(strict_types=1);

return [
    'title' => 'Design Auction System',
    'leetcode' => 3815,
    'difficulty' => 'Med',
    'summary' => 'Keep a map from (user, item) to amount, and per item a max-heap of (amount, userId). Updates push a new entry; stale heap tops (not matching the current map) are popped lazily when asked for the highest bidder.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'design-auction-system',
    'related_session' => 'design-auction-system',
];
