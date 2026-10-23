<?php
declare(strict_types=1);

return [
    'title' => 'Booking Concert Tickets in Groups',
    'leetcode' => 2286,
    'difficulty' => 'Hard',
    'summary' => 'Seats in each row fill left to right, so track used[r]. gather finds the first row ≤ maxRow with m − used ≥ k (segment tree of max free). scatter succeeds if total free in rows 0..maxRow ≥ k, then fills from the lowest rows.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'booking-concert-tickets-in-groups',
    'related_session' => 'booking-concert-tickets-in-groups',
];
