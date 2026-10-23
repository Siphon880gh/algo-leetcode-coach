<?php
declare(strict_types=1);

return [
    'title' => 'Find the Minimum Amount of Time to Brew Potions: earliest synchronized start',
    'leetcode' => 3494,
    'difficulty' => 'Med',
    'summary' => 'A potion must flow through the wizards without waiting. With prefix skill sums pre, wizard i would start it at t + x · pre[i]; that must be at least when wizard i finished the previous potion. So t is the largest done[i] − x · pre[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'tags' => ['mini-game', 'leetcode', 'simulation'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-minimum-amount-of-time-to-brew-potions',
    'related_session' => 'find-the-minimum-amount-of-time-to-brew-potions',
];
