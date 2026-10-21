<?php
declare(strict_types=1);

return [
    'title' => 'Satisfiability of Equality Equations: equalities first',
    'leetcode' => 990,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: union every "==" pair first, then reject any "!=" whose two variables ended up in the same set. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'satisfiability-of-equality-equations',
    'tags' => ['union-find', 'graphs', 'strings', 'step-by-step'],
];
