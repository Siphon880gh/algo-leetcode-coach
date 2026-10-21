<?php
declare(strict_types=1);

return [
    'title' => 'HTML Entity Parser: one left-to-right scan',
    'leetcode' => 1410,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: copy characters, and at each & try the six known entities, appending the decoded character and skipping on a match. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'html-entity-parser',
    'tags' => ['strings', 'step-by-step'],
];
