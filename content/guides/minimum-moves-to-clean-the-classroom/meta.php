<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Clean the Classroom: BFS over cell, litter mask and energy',
    'leetcode' => 3568,
    'difficulty' => 'Med',
    'summary' => 'At most 10 litter cells, so the state is (cell, collected mask, energy). BFS by moves; keep the best energy seen per (cell, mask) and skip states that are not better.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['breadth-first-search', 'bit-manipulation', 'array', 'hash-table', 'matrix', 'leetcode'],
    'related_session' => 'minimum-moves-to-clean-the-classroom',
];
