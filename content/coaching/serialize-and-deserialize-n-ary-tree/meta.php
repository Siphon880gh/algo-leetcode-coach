<?php
declare(strict_types=1);

return [
    'title' => 'Serialize and Deserialize N-ary Tree: BFS children then a # terminator',
    'leetcode' => 428,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: encode an N-ary tree to a string and back. BFS from the root; for each dequeued node, write its children values then a # so the decoder knows where that child list ends. Decode by reading children until #. Stateless codec. Not 297 / 431. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'bfs', 'serialization', 'step-by-step'],
    'related_guide' => 'serialize-and-deserialize-n-ary-tree',
];
