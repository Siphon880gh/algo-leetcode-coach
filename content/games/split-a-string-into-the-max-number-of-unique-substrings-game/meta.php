<?php
declare(strict_types=1);

return [
    'title' => 'Split a String Into the Max Number of Unique Substrings',
    'leetcode' => 1593,
    'difficulty' => 'Med',
    'summary' => 'Backtrack over the next cut, keeping a set of used pieces; a piece can be used only if it is not already in the set. Prune when the remaining length cannot beat the best.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'split-a-string-into-the-max-number-of-unique-substrings',
    'related_session' => 'split-a-string-into-the-max-number-of-unique-substrings',
];
