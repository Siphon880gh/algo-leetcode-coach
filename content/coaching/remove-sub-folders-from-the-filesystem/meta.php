<?php
declare(strict_types=1);

return [
    'title' => 'Remove Sub-Folders: sorted prefix check',
    'leetcode' => 1233,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort the paths, keep one unless it starts with the last kept path plus a slash, and return the kept list. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'remove-sub-folders-from-the-filesystem',
    'tags' => ['strings', 'sorting', 'trie', 'step-by-step'],
];
