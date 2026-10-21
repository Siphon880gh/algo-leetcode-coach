<?php
declare(strict_types=1);

return [
    'title' => 'Ternary Expression Parser: scan right to left with a stack',
    'leetcode' => 439,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: evaluate a nested ternary of T, F, digits, ? and :. Ternaries group right to left, so scan from the right, push values, and at each ? pop the two branches and push the one the condition picks. "F?1:T?4:5" → "4". "T?T?F:5:3" → "F". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'strings', 'recursion', 'step-by-step'],
    'related_guide' => 'ternary-expression-parser',
];
