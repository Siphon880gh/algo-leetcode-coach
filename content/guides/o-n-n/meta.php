<?php
declare(strict_types=1);

return [
    'title' => 'When O(n) still times out',
    'summary' => 'A single loop can still time out when each pass hides a large cost, such as copying a string or scanning a list inside an innocent-looking call.',
    'category' => 'Algorithms',
    'subcategory' => 'Complexity',
    'kind' => 'algo',
    'tags' => ['performance', 'pitfalls'],
    'related_session' => 'o-n-n',
    'topic' => 'Algorithms · Complexity',
];
