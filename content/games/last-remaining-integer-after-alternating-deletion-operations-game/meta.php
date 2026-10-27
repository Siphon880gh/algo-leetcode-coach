<?php
declare(strict_types=1);

return [
    'title' => 'Last Remaining Integer After Alternating Deletion Operations',
    'leetcode' => 3782,
    'difficulty' => 'Hard',
    'summary' => 'Track only the head, the gap between survivors and the count. A left-to-right pass always removes the head; a right-to-left pass removes it only when the count is even. Each pass halves the count and doubles the gap, so n up to 1e15 takes about 50 passes.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'last-remaining-integer-after-alternating-deletion-operations',
    'related_session' => 'last-remaining-integer-after-alternating-deletion-operations',
];
