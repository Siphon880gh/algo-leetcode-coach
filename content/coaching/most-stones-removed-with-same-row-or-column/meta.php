<?php
declare(strict_types=1);

return [
    'title' => 'Most Stones Removed: stones minus groups',
    'leetcode' => 947,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: stones sharing a row or column are connected, each connected group can be cut down to one stone, so the answer is n minus the number of groups. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'most-stones-removed-with-same-row-or-column',
    'tags' => ['union-find', 'graphs', 'depth-first-search', 'step-by-step'],
];
