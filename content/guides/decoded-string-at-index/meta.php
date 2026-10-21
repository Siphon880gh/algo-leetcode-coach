<?php
declare(strict_types=1);

return [
    'title' => 'Decoded String at Index: work backward from the total length',
    'leetcode' => 880,
    'difficulty' => 'Med',
    'summary' => 'Compute the decoded length without building it. Then walk the encoding backward: k %= size; a letter at k == 0 is the answer, a digit divides the size, a letter shrinks it by one.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'strings', 'math', 'leetcode'],
    'related_session' => 'decoded-string-at-index',
];
