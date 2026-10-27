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
            'message' => "State:\n0-based array [1, 2, 3, 4, 5]\nnode at index i = 1 (value 2)\n\nWhat is the index of its left child?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3, from 2 × 1 + 1', 'next' => 'parent'],
                ['label' => '2, from 2 × 1 (the 1-based formula used on a 0-based array)', 'next' => 'w_formula'],
            ],
        ],
        'w_formula' => [
            'message' => "Wrong.\n\nWith 0-based indexing the left child is at 2i + 1. Index 2 is the root's right child.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'parent' => [
            'message' => "State:\nnode at index i = 4\n\nWhat is the index of its parent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, from (4 − 1) // 2', 'next' => 'sparse'],
                ['label' => '8, from 2 × 4', 'next' => 'w_par'],
            ],
        ],
        'w_par' => [
            'message' => "Wrong.\n\nWith 0-based indexing the parent is at (i − 1) // 2. 2 × 4 would point down to a child, not up.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'parent',
            'choices' => [],
        ],
        'sparse' => [
            'message' => "State:\nthe tree is very sparse, almost a single chain\n\nWhat is the best way to store it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pointer-based nodes, because an array would leave many empty slots', 'next' => 'success'],
                ['label' => 'Always an array, because empty slots cost nothing', 'next' => 'w_holes'],
            ],
        ],
        'w_holes' => [
            'message' => "Wrong.\n\nArray storage shines for complete shapes like heaps. A chain-like tree would waste most of the array.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'sparse',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- With 0-based indexing, the left child is at 2i + 1 and the right child at 2i + 2.\n- This layout is best for complete trees and heaps.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
