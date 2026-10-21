<?php
declare(strict_types=1);

return [
    'title' => 'Remove Comments: a scanner that remembers block mode across lines',
    'leetcode' => 722,
    'difficulty' => 'Med',
    'summary' => 'Scan characters with a flag for "inside a block comment" that survives line breaks. Outside a block, // drops the rest of the line and /* enters block mode; inside, only */ matters. Emit a line only when not in block mode and the buffer is non-empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'simulation', 'parsing', 'leetcode'],
    'related_session' => 'remove-comments',
];
