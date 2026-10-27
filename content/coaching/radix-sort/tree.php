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
            'message' => "State:\nLSD radix sort on base-10 integers\n\nWhich digit does the first pass use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The ones place, the least significant digit', 'next' => 'mid'],
                ['label' => 'Only the highest place', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nClassic LSD radix sort starts at the least significant digit.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\none digit pass uses an unstable quicksort-style partition\n\nWhat goes wrong?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Later passes cannot restore the order, so every pass must be stable', 'next' => 'final'],
                ['label' => 'Nothing, because radix sort does not need stability', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nEach digit pass must keep the order produced by the earlier passes.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn keys, d digits, base b\n\nWhat is the time cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(d · (n + b))', 'next' => 'success'],
                ['label' => 'O(n log n) comparisons, necessarily', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nRadix sort never compares keys. It pays for d counting passes instead.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Sort digit by digit, starting from the least significant.\n- Every pass is stable.\n- The time is O(d · (n + b)).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
