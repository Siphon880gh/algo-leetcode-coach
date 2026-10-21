<?php
declare(strict_types=1);

return [
    'title' => 'Find And Replace in String: match against the original, then rebuild',
    'leetcode' => 833,
    'difficulty' => 'Med',
    'summary' => 'All replacements look at the original string at once. Check each operation\'s source at its index, record the matching ones by index, then build the result left to right, copying the target and skipping the source where an operation matched.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'hash-map', 'sorting', 'leetcode'],
    'related_session' => 'find-and-replace-in-string',
];
