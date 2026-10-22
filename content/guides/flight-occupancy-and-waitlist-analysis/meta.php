<?php
declare(strict_types=1);

return [
    'title' => 'Flight Occupancy and Waitlist Analysis: seats are capped at capacity',
    'leetcode' => 2783,
    'difficulty' => 'Med',
    'summary' => 'Count bookings per flight with a left join so empty flights still appear. Seated is the smaller of that count and the capacity; waitlisted is whatever exceeds the capacity, never negative.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'flight-occupancy-and-waitlist-analysis',
];
