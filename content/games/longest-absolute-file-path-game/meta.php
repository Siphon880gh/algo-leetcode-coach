<?php
declare(strict_types=1);

return [
    'title' => 'Longest Absolute File Path',
    'leetcode' => 388,
    'difficulty' => 'Med',
    'summary' => 'Process lines; the number of tabs is the depth. Keep a stack of cumulative path lengths per depth: len[d] = len[d−1] + name length + 1. Files (names with ".") update the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-absolute-file-path',
    'related_session' => 'longest-absolute-file-path',
];
