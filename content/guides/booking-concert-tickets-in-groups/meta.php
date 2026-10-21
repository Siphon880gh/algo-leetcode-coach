<?php
declare(strict_types=1);

return [
    'title' => 'Booking Concert Tickets in Groups: segment tree of max and sum',
    'leetcode' => 2286,
    'difficulty' => 'Hard',
    'summary' => 'A segment tree over rows stores the maximum free seats and the total free seats. gather finds the leftmost row ≤ maxRow with at least k free; scatter checks the free total of rows 0 … maxRow, then fills rows from the first non-full one.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'binary-indexed-tree', 'segment-tree', 'binary-search', 'leetcode'],
    'related_session' => 'booking-concert-tickets-in-groups',
];
