<?php
declare(strict_types=1);

return [
    'title' => 'Find the Minimum Amount of Time to Brew Potions: earliest synchronized start',
    'leetcode' => 3494,
    'difficulty' => 'Med',
    'summary' => 'A potion must flow through the wizards without waiting. With prefix skill sums pre, wizard i starts potion j at t plus mana[j] times pre[i], and that must be no earlier than when wizard i finished the previous potion. So t is the largest done[i] minus mana[j] times pre[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'tags' => ['mini-game', 'leetcode', 'simulation'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-minimum-amount-of-time-to-brew-potions',
    'related_session' => 'find-the-minimum-amount-of-time-to-brew-potions',
];
