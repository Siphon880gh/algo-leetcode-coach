<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search by comparison, then handle the node by how many children it has', 'next' => 's2'],
                ['label' => 'Collect all values except key and rebuild a balanced BST', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rebuilding from a sorted list costs O(n) and throws away the tree's shape for no reason.\nStep back to when you rebuilt the whole tree.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Found the node. It has 0 or 1 child.\nWhat do you return in its place?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always null', 'next' => 'wrong_b'],
                ['label' => 'Its only child (or null if it has none)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Returning null when there is one child drops that whole subtree.\nStep back to when you returned null.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two children: let s = the leftmost node of the right subtree. Copy s.val into this node, then delete s.val from the right subtree. O(h) time and space. Insert into a BST (701) only adds leaves.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the successor (min of right). Reattach the returned subtrees', 'next' => 'success'],
                ['label' => 'Use the right child itself as the replacement value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any node from the right subtree is not enough; only its minimum is larger than everything on the left and smaller than the rest of the right.\nStep back to when you picked the replacement.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Search, then 0 or 1 child returns the child; 2 children copies the successor and deletes it below. Example → [5,4,6,2,null,null,7].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
