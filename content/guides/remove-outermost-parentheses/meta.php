<?php
declare(strict_types=1);

return [
    'title' => 'Remove Outermost Parentheses: track the depth',
    'leetcode' => 1021,
    'difficulty' => 'Easy',
    'summary' => 'Scan with a depth counter. Keep an opening parenthesis only when the depth before it is above 0, and a closing one only when the depth after it is above 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'strings', 'leetcode'],
    'related_session' => 'remove-outermost-parentheses',
];
