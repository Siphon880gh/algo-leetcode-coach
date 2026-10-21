<?php
declare(strict_types=1);

return [
    'title' => 'HTML Entity Parser: scan and match at each &',
    'leetcode' => 1410,
    'difficulty' => 'Med',
    'summary' => 'Scan the text; at each &, check whether one of the six known entities starts there and, if so, append its character and skip it. Otherwise copy the character as is.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'leetcode'],
    'related_session' => 'html-entity-parser',
];
