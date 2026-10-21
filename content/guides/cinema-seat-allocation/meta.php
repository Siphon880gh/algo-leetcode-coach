<?php
declare(strict_types=1);

return [
    'title' => 'Cinema Seat Allocation: three blocks per reserved row',
    'leetcode' => 1386,
    'difficulty' => 'Med',
    'summary' => 'A family needs seats 2–5, 6–9, or 4–7. Rows without reservations hold 2 families. For each reserved row, check the left and right blocks; if neither is free, the middle block may still fit one.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'bit-manipulation', 'hash-map', 'leetcode'],
    'related_session' => 'cinema-seat-allocation',
];
