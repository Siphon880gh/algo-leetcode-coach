<?php
declare(strict_types=1);

return [
    'title' => 'Time Needed to Buy Tickets: turns before k finishes',
    'leetcode' => 2073,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: people up to k buy min(t[i], t[k]), people behind buy min(t[i], t[k] − 1), moving costs nothing. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'related_guide' => 'time-needed-to-buy-tickets',
    'tags' => ['simulation', 'queue', 'array', 'step-by-step'],
];
