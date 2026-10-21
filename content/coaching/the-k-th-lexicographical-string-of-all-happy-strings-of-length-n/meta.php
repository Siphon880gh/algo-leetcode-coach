<?php
declare(strict_types=1);

return [
    'title' => 'The k-th Lexicographical Happy String of Length n: count, then descend',
    'leetcode' => 1415,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: there are 3·2^(n−1) happy strings. If k exceeds that, return "". Otherwise pick each character by dividing k−1 by the block size of each branch. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'the-k-th-lexicographical-string-of-all-happy-strings-of-length-n',
    'tags' => ['math', 'backtracking', 'strings', 'step-by-step'],
];
