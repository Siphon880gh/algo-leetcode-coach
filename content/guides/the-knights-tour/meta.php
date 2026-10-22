<?php
declare(strict_types=1);

return [
    'title' => 'The Knight’s Tour: backtracking, best with Warnsdorff order',
    'leetcode' => 2664,
    'difficulty' => 'Med',
    'summary' => 'Depth-first search: from the current cell try each unvisited knight move, write the step number, recurse, and erase it on failure. Trying moves with the fewest onward options first (Warnsdorff’s rule) finds tours much faster.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['array', 'backtracking', 'matrix', 'leetcode'],
    'related_session' => 'the-knights-tour',
];
