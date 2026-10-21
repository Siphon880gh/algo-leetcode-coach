<?php
declare(strict_types=1);

return [
    'title' => 'Tag Validator: CDATA first, then tags, with a stack',
    'leetcode' => 591,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: test CDATA before tags, allow text only inside an open tag, and accept only when the stack empties at the very end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'tag-validator',
    'tags' => ['stack', 'strings', 'parsing', 'step-by-step'],
];
