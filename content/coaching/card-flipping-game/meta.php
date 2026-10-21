<?php
declare(strict_types=1);

return [
    'title' => 'Card Flipping Game: same-card doubles are blocked',
    'leetcode' => 822,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: numbers on both sides of one card can never be good; every other number can, so take the smallest. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Map',
    'topic' => 'LeetCode · Hash Map',
    'related_guide' => 'card-flipping-game',
    'tags' => ['hash-set', 'arrays', 'step-by-step'],
];
