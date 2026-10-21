<?php
declare(strict_types=1);

return [
    'title' => 'Cinema Seat Allocation: blocks per reserved row',
    'leetcode' => 1386,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: rows without reservations hold 2 families; for each reserved row, count free left (2–5) and right (6–9) blocks, else try the middle (4–7). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'cinema-seat-allocation',
    'tags' => ['greedy', 'bit-manipulation', 'hash-map', 'step-by-step'],
];
