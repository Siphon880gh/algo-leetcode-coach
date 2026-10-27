<?php
declare(strict_types=1);

return [
    'title' => 'AVL Tree Insertions',
    'summary' => 'Insert as in a BST, then walk back up updating heights. Balance factor = height(left) − height(right). If it leaves the range −1 to 1, rotate: LL (new key in the left child\'s left side) right-rotates, RR left-rotates, LR rotates the child left then the node right, RL is the mirror.',
    'category' => 'Data Structures',
    'subcategory' => 'Trees',
    'topic' => 'Data Structures · Trees',
    'tags' => ['tree', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'avl-tree',
    'related_session' => 'avl-tree',
];
