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
            'message' => "State:\nyou are starting to learn binary trees\n\nWhich skill comes first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Traversal, with DFS and BFS', 'next' => 'mid'],
                ['label' => 'AVL rotations', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nLearn to walk a tree before learning to balance one.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou want the height of a node\n\nWhat is the natural approach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recurse on the left and right children', 'next' => 'final'],
                ['label' => 'Only BFS can compute height', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nComputing height with a DFS recursion is the classic approach.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou are comfortable with traversals\n\nWhat do you specialize in next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search tree and heap rules', 'next' => 'success'],
                ['label' => 'Skip ahead to network flow', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nBinary search trees and heaps build directly on binary trees.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- First traverse.\n- Then recurse on the children.\n- Then specialize.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
