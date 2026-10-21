<?php
declare(strict_types=1);

return [
    'title' => 'Word Squares: next row is the prefix already written down the column',
    'leetcode' => 425,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: build every word square from unique same-length words (reuse allowed). After r rows, the next word must start with the letters already in column r. A prefix trie returns those candidates. ["area","lead","wall","lady","ball"] → two squares. Not 422. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'tags' => ['trie', 'backtracking', 'strings', 'step-by-step'],
    'related_guide' => 'word-squares',
];
