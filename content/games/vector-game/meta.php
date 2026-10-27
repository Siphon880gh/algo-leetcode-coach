<?php
declare(strict_types=1);

return [
    'title' => 'Vector: When Does an Append Resize?',
    'summary' => 'A vector (C++ vector, Java ArrayList) holds size values in a buffer of some capacity. An append with size < capacity just writes. An append with size = capacity allocates a buffer of twice the capacity, copies all values, then writes.',
    'category' => 'Data Structures',
    'subcategory' => 'Arrays',
    'topic' => 'Data Structures · Arrays',
    'tags' => ['array', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'vector',
    'related_session' => 'vector',
];
