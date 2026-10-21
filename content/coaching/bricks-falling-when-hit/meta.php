<?php
declare(strict_types=1);

return [
    'title' => 'Bricks Falling When Hit: add the bricks back in reverse',
    'leetcode' => 803,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: apply all hits, build union-find with a roof node, then restore hits backward and measure how much the roof component grows. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'bricks-falling-when-hit',
    'tags' => ['union-find', 'graphs', 'matrix', 'step-by-step'],
];
