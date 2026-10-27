<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Subsequences After One Inserting',
    'leetcode' => 3628,
    'difficulty' => 'Med',
    'summary' => 'Three candidates: an L at the front adds every "CT"; a T at the end adds every "LC"; a C at position i adds (L before i) times (T after i), best i. Add the best gain to the current "LCT" count.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-subsequences-after-one-inserting',
    'related_session' => 'maximum-number-of-subsequences-after-one-inserting',
];
