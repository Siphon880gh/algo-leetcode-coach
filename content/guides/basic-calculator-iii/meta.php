<?php
declare(strict_types=1);

return [
    'title' => 'Basic Calculator III: recursion for parentheses, a stack for precedence',
    'leetcode' => 772,
    'difficulty' => 'Hard',
    'summary' => 'Process one level at a time with a stack: + and − push signed numbers, * and / combine with the stack top immediately. On "(" recurse and treat the returned value as a number; on ")" return the stack sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'recursion', 'parsing', 'math', 'strings', 'leetcode'],
    'related_session' => 'basic-calculator-iii',
];
