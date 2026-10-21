<?php
declare(strict_types=1);

return [
    'title' => 'Seat Reservation Manager: min-heap of returned seats',
    'leetcode' => 1845,
    'difficulty' => 'Med',
    'summary' => 'Keep a pointer to the next never-used seat and a min-heap of unreserved seats. reserve pops the heap if non-empty, else uses the pointer; unreserve pushes.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'design', 'leetcode'],
    'related_session' => 'seat-reservation-manager',
];
