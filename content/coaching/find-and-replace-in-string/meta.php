<?php
declare(strict_types=1);

return [
    'title' => 'Find And Replace in String: match on the original, build once',
    'leetcode' => 833,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: every replacement is checked against the original string, so record which indices match, then build the result in one left-to-right pass. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'find-and-replace-in-string',
    'tags' => ['strings', 'hash-map', 'sorting', 'step-by-step'],
];
