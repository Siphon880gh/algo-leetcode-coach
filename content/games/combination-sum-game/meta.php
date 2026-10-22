<?php
declare(strict_types=1);

return [
    'title' => 'Combination Sum: reuse from the same index, prune on overshoot',
    'leetcode' => 39,
    'difficulty' => 'Med',
    'summary' => 'Candidates are sorted. From index start, try each candidate in order; recurse with the SAME index (reuse allowed). Never go back to earlier indexes (no duplicate combos). Once a candidate overshoots, every later one does too: stop.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'combination-sum',
    'related_session' => 'combination-sum',
];
