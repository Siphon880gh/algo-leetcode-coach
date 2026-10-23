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
            'message' => "State:\n0-based array [1,2,3,4,5]\nnode index i = 1 (value 2)\n\nLeft child index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3 — 2*1 + 1', 'next' => 'parent'],
                ['label' => '2 — 2*1 (1-based formula on a 0-based array)', 'next' => 'w_formula'],
            ],
        ],
        'w_formula' => [
            'message' => "Wrong.\n\nOn 0-based heaps, left is 2i+1. Index 2 is the right child of root.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'parent' => [
            'message' => "State:\ni = 4\n\nParent index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 — (4-1)//2', 'next' => 'sparse'],
                ['label' => '8 — 2*4', 'next' => 'w_par'],
            ],
        ],
        'w_par' => [
            'message' => "Wrong.\n\nParent is (i-1)//2 for 0-based heaps.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'parent',
            'choices' => [],
        ],
        'sparse' => [
            'message' => "State:\ntree is very sparse (almost a chain)\n\nIdeal storage?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pointer nodes — array would leave many holes', 'next' => 'success'],
                ['label' => 'Always an array — holes are free', 'next' => 'w_holes'],
            ],
        ],
        'w_holes' => [
            'message' => "Wrong.\n\nArray packing shines for complete shapes like heaps.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'sparse',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- 0-based: left 2i+1, right 2i+2\n- Best for complete trees/heaps\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
