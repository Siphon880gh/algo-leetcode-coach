<?php
declare(strict_types=1);

return [
    'title' => 'RAM and cache: why contiguous layouts run faster',
    'summary' => 'CPUs load memory a cache line at a time, so walking an array streams quickly while following linked-list pointers jumps around and stalls.',
    'category' => 'Data Structures',
    'subcategory' => 'Fundamentals',
    'kind' => 'algo',
    'tags' => ['cache', 'locality', 'RAM'],
    'related_session' => 'random-access-memory-and-cache',
    'topic' => 'Data Structures · Fundamentals',
];
