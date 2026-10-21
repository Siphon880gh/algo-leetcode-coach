<?php
declare(strict_types=1);

return [
    'title' => 'Time Needed to Buy Tickets: count each person\'s turns',
    'leetcode' => 2073,
    'difficulty' => 'Easy',
    'summary' => 'Everyone ahead of or at k buys min(tickets[i], tickets[k]) tickets before k finishes; everyone behind buys min(tickets[i], tickets[k] − 1). Sum those seconds.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'kind' => 'algo',
    'tags' => ['simulation', 'queue', 'array', 'leetcode'],
    'related_session' => 'time-needed-to-buy-tickets',
];
