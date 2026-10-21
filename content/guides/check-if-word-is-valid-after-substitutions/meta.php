<?php
declare(strict_types=1);

return [
    'title' => 'Check If Word Is Valid After Substitutions: remove "abc" with a stack',
    'leetcode' => 1003,
    'difficulty' => 'Med',
    'summary' => 'A valid word can be emptied by repeatedly deleting "abc". Push characters onto a stack, and whenever the top three are a, b, c, pop them. The word is valid if the stack ends empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'strings', 'leetcode'],
    'related_session' => 'check-if-word-is-valid-after-substitutions',
];
