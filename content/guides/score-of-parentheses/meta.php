<?php
declare(strict_types=1);

return [
    'title' => 'Score of Parentheses: each "()" is worth 2^depth',
    'leetcode' => 856,
    'difficulty' => 'Med',
    'summary' => 'Only the innermost "()" pairs create score; each enclosing pair doubles it. Walk the string tracking depth and add 1 << depth whenever a ")" directly follows a "(".',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'strings', 'leetcode'],
    'related_session' => 'score-of-parentheses',
];
