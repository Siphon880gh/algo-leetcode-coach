<?php
declare(strict_types=1);

return [
    'title' => 'Check If Word Is Valid After Substitutions: stack for abc',
    'leetcode' => 1003,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: push characters; on each c, the top two must be b and a, so pop them; the word is valid when the stack ends empty. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'check-if-word-is-valid-after-substitutions',
    'tags' => ['stack', 'strings', 'step-by-step'],
];
