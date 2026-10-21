<?php
declare(strict_types=1);

return [
    'title' => 'Hand of Straights: the smallest card starts a group',
    'leetcode' => 846,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count the cards, then repeatedly take the smallest card x with count c and remove c copies of each of x … x + groupSize − 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'hand-of-straights',
    'tags' => ['greedy', 'hash-map', 'sorting', 'step-by-step'],
];
