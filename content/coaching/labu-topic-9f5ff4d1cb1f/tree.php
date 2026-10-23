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
            'message' => "State:\nsorted [1,2,4,7], sum 6, L=0 R=3\n\n1+7=8. Move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'R--', 'next' => 'mid'],
                ['label' => 'L++ only', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nSum too big on sorted data → shrink R.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nremove zeros in-place\n\nPointer style?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same-direction slow/fast writer', 'next' => 'final'],
                ['label' => 'Opposite ends only', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nFilter patterns use slow writer + fast reader.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn elements, each pointer moves ≤n\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n²)', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nMonotone pointers are linear.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Opposite ends or slow/fast\n- Invariant + monotone moves\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
