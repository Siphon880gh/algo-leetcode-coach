<?php
declare(strict_types=1);

return [
    'title' => 'Stickers to Spell Word: always cover the first missing letter',
    'leetcode' => 691,
    'difficulty' => 'Hard',
    'summary' => 'Memoize on the letters still needed. Only try stickers that contain the first needed letter (some sticker must cover it); each one removes what it can, then recurse.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'stickers-to-spell-word',
    'related_session' => 'stickers-to-spell-word',
];
