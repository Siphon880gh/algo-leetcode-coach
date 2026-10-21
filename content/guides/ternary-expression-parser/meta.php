<?php
declare(strict_types=1);

return [
    'title' => 'Ternary Expression Parser: scan right to left with a stack',
    'leetcode' => 439,
    'difficulty' => 'Med',
    'summary' => 'Evaluate a valid nested ternary of T, F, single digits, ? and :. Ternaries group right to left, so scan from the right and push values; when a condition sits before a ?, pop the two branches and push the chosen one. "T?2:3" → "2". "F?1:T?4:5" → "4". "T?T?F:5:3" → "F".',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'strings', 'recursion', 'leetcode'],
    'related_session' => 'ternary-expression-parser',
];
