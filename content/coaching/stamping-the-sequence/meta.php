<?php
declare(strict_types=1);

return [
    'title' => 'Stamping the Sequence: peel stamps off in reverse',
    'leetcode' => 936,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: the last stamp is fully visible, so repeatedly turn a window matching the stamp (with "?" as wildcard and at least one real letter) into "?", then reverse the order. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'stamping-the-sequence',
    'tags' => ['greedy', 'strings', 'queue', 'step-by-step'],
];
