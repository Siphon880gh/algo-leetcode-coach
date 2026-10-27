<?php
declare(strict_types=1);

return [
    'title' => 'Color-Marked Iterative Inorder',
    'summary' => 'One stack of (node, color) pairs. Pop a pair. A white (new) node is expanded: push right as white, the node itself as gray, then left as white, so the left side pops first. A gray node is output. Moving the gray push changes the order to preorder or postorder.',
    'category' => 'Data Structures',
    'subcategory' => 'Trees',
    'topic' => 'Data Structures · Trees',
    'tags' => ['tree', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'labu-topic-a438281d8510',
    'related_session' => 'labu-topic-a438281d8510',
];
