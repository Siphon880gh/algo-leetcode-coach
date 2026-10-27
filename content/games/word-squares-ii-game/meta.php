<?php
declare(strict_types=1);

return [
    'title' => 'Word Squares II',
    'leetcode' => 3799,
    'difficulty' => 'Med',
    'summary' => 'Try every ordered choice of 4 distinct words (top, left, right, bottom) and keep those whose corners match: top[0] = left[0], top[3] = right[0], bottom[0] = left[3], bottom[3] = right[3]. Pruning on each corner as soon as a word is placed keeps it fast; sort the results.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'word-squares-ii',
    'related_session' => 'word-squares-ii',
];
