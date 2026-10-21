<?php
declare(strict_types=1);

return [
    'title' => 'Tag Validator: one scan with a stack of open tags',
    'leetcode' => 591,
    'difficulty' => 'Hard',
    'summary' => 'Scan left to right with a stack of tag names. Handle CDATA, closing tags, and opening tags in that order; any other text must sit inside a tag, and the stack may only empty at the very end.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'strings', 'parsing', 'leetcode'],
    'related_session' => 'tag-validator',
];
