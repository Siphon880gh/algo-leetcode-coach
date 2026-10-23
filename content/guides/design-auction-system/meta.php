<?php
declare(strict_types=1);

return [
    'title' => 'Design Auction System: per-item heaps with lazy deletion',
    'leetcode' => 3815,
    'difficulty' => 'Med',
    'summary' => 'Keep each item’s live bids in a map and push (amount, userId) onto a max-heap for every add or update. When asked for the top bidder, pop entries that no longer match the map.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'leetcode'],
    'related_session' => 'design-auction-system',
];
