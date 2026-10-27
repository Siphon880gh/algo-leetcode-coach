<?php
declare(strict_types=1);

return [
    'title' => 'Check for Contradictions in Equations',
    'leetcode' => 2307,
    'difficulty' => 'Hard',
    'summary' => 'Weighted union-find storing each variable\'s ratio to its root. When both sides already share a root, compare ratio(a) divided by ratio(b) with the given value (tolerance 1e-5); a mismatch is a contradiction.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'check-for-contradictions-in-equations',
    'related_session' => 'check-for-contradictions-in-equations',
];
