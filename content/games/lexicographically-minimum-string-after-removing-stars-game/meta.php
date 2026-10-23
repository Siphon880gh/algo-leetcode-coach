<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Minimum String After Removing Stars',
    'leetcode' => 3170,
    'difficulty' => 'Med',
    'summary' => 'Keep a stack of indices per letter. Each "*" deletes the smallest letter to its left, choosing its rightmost occurrence (pop from that letter\'s stack). Output the surviving letters in order.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'lexicographically-minimum-string-after-removing-stars',
    'related_session' => 'lexicographically-minimum-string-after-removing-stars',
];
