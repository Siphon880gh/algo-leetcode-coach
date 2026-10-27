<?php
declare(strict_types=1);

return [
    'title' => 'Count Routes to Climb a Rectangular Grid',
    'leetcode' => 3797,
    'difficulty' => 'Hard',
    'summary' => 'Process rows bottom to top. arrive[c] = ways to enter (r, c). A route may then make one sideways move within distance d: fin[c] = arrive[c] + Σ arrive[c\'] over open c\' ≠ c with |c − c\'| ≤ d. Moving up needs (Δc)² + 1 ≤ d². Sliding-window prefix sums make each row O(m).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-routes-to-climb-a-rectangular-grid',
    'related_session' => 'count-routes-to-climb-a-rectangular-grid',
];
