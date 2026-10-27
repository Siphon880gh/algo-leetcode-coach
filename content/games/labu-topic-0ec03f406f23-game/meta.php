<?php
declare(strict_types=1);

return [
    'title' => 'Stock Trading as a State Machine',
    'summary' => 'Hold at most one share; trade as often as you like. After each price p: cash = max(cash, hold + p) (sell or rest) and hold = max(hold, cash_before − p) (buy or rest). Start cash = 0, hold = −infinity. The answer is the final cash.',
    'category' => 'Algorithms',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'Algorithms · Dynamic Programming',
    'tags' => ['dp', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'labu-topic-0ec03f406f23',
    'related_session' => 'labu-topic-0ec03f406f23',
];
