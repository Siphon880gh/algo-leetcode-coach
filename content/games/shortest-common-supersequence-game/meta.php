<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Common Supersequence: LCS, then weave',
    'leetcode' => 1092,
    'difficulty' => 'Hard',
    'summary' => 'Build the LCS table. Walk back from the end: equal letters are written once; otherwise write the letter from the side whose LCS stays larger. Length = m + n − LCS.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'shortest-common-supersequence',
    'related_session' => 'shortest-common-supersequence',
];
