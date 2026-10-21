<?php
declare(strict_types=1);

return [
    'title' => 'Positions of Large Groups: runs of length 3 or more',
    'leetcode' => 830,
    'difficulty' => 'Easy',
    'summary' => 'Scan with a run start. When the letter changes (or the string ends), record [start, i − 1] if the run has at least 3 letters, then start a new run.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'strings', 'leetcode'],
    'related_session' => 'positions-of-large-groups',
];
