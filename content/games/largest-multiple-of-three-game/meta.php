<?php
declare(strict_types=1);

return [
    'title' => 'Largest Multiple of Three: drop the fewest smallest digits',
    'leetcode' => 1363,
    'difficulty' => 'Hard',
    'summary' => 'Sort digits descending. If the digit sum mod 3 = r ≠ 0, remove one smallest digit with that remainder, or else two smallest with remainder 3 − r. Leading zeros collapse to "0".',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'largest-multiple-of-three',
    'related_session' => 'largest-multiple-of-three',
];
