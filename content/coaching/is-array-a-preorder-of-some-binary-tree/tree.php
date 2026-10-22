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
            'message' => "Problem: You get a list of nodes, each giving its own id and its parent’s id, with the root having no parent. Decide whether the list, in the given order, is a preorder traversal of the tree those parent links describe, for some order of each node’s children. The input format and limits are in the official statement. For instance, with root 0, children 1 and 2 of 0, and children 3 and 4 of 2, the order 0, 1, 2, 3, 4 is a preorder; if 3 and 4 are children of 1 instead, it is not. (Restated from memory; limits and examples may differ slightly.)\nCheck each new node against?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any node on the current root path, popping to it', 'next' => 's2'],
                ['label' => 'Only the node just before it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A node can follow a finished subtree; the first example → false instead of true.\nStep back to when you checked only the previous node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The stack empties while popping?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push the node anyway', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Its parent was already closed; the second example → true instead of false.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
