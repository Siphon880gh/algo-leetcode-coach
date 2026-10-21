<?php
declare(strict_types=1);

return [
    'title' => 'Valid Tic-Tac-Toe State: counts and winners must agree',
    'leetcode' => 794,
    'difficulty' => 'Med',
    'summary' => 'X moves first, so x count equals o count or o + 1. If X has won, x must be o + 1; if O has won, x must equal o. Both cannot have won with those counts.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'kind' => 'algo',
    'tags' => ['simulation', 'matrix', 'strings', 'leetcode'],
    'related_session' => 'valid-tic-tac-toe-state',
];
