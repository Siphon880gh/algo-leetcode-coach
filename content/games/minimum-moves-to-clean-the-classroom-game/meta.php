<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Clean the Classroom',
    'leetcode' => 3568,
    'difficulty' => 'Med',
    'summary' => 'BFS over states (cell, energy left, bitmask of litter collected). A move costs 1 energy, stepping on R refills it, and 0 energy off an R means stuck. The first state with every litter bit set gives the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-moves-to-clean-the-classroom',
    'related_session' => 'minimum-moves-to-clean-the-classroom',
];
