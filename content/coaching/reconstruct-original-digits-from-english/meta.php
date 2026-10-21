<?php
declare(strict_types=1);

return [
    'title' => 'Reconstruct Original Digits from English: unique letters first',
    'leetcode' => 423,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: s is a shuffled bag of English digit words. Count letters. z, w, u, x, g pin 0, 2, 4, 6, 8. Then h, f, s give 3, 5, 7. Then o and i give 1 and 9. Emit digits in ascending order. "owoztneoer" → "012". "fviefuro" → "45". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash-table', 'math', 'strings', 'step-by-step'],
    'related_guide' => 'reconstruct-original-digits-from-english',
];
