<?php
declare(strict_types=1);

return [
    'title' => 'Output Contest Matches: pair first with last, round by round',
    'leetcode' => 544,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: bracket string for n = 2^x seeds, strongest vs weakest each round. Keep strings ["1"…"n"] and repeatedly pair a[i] with a[len − 1 − i] as "(a,b)". n = 8 → "(((1,8),(4,5)),((2,7),(3,6)))". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Recursion',
    'topic' => 'LeetCode · Recursion',
    'tags' => ['recursion', 'simulation', 'strings', 'step-by-step'],
    'related_guide' => 'output-contest-matches',
];
