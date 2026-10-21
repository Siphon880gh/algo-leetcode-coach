<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of a Concatenated String with Unique Characters: bitmask backtracking',
    'leetcode' => 1239,
    'difficulty' => 'Med',
    'summary' => 'Turn each string into a 26-bit mask, dropping strings that repeat a letter. Backtrack over the masks, adding one only when it does not overlap the current set, and track the largest bit count.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'bit-manipulation', 'strings', 'leetcode'],
    'related_session' => 'maximum-length-of-a-concatenated-string-with-unique-characters',
];
