<?php
declare(strict_types=1);

return [
    'title' => 'Number Encoding: 8-bit Two\'s Complement',
    'summary' => 'A signed 8-bit integer stores x as the bit pattern of x mod 256: 5 is 00000101 and −1 is 11111111. The top bit means negative. Sums past 127 or below −128 wrap around, so 127 + 1 becomes −128.',
    'category' => 'Algorithms',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'Algorithms · Bit Manipulation',
    'tags' => ['bits', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'number-encoding',
    'related_session' => 'number-encoding',
];
