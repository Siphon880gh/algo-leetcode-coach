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
            'message' => "State:\na = [3, 1, 4, 2]\npass for index 0\n\nWhat do you swap into index 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 — the minimum of the whole array', 'next' => 'inv'],
                ['label' => '2 — the median', 'next' => 'w_med'],
            ],
        ],
        'w_med' => [
            'message' => "Wrong.\n\nSelection sort pulls the minimum of the unsorted suffix.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'inv' => [
            'message' => "State:\nafter 2 passes\n\nInvariant for the prefix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[0..1] holds the 2 smallest items, sorted', 'next' => 'complex'],
                ['label' => 'Only a[0] is sorted; the rest is random heap order', 'next' => 'w_inv'],
            ],
        ],
        'w_inv' => [
            'message' => "Wrong.\n\nEach pass grows a sorted prefix of the next minima.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'inv',
            'choices' => [],
        ],
        'complex' => [
            'message' => "State:\nn elements\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²) — each pass rescans the suffix', 'next' => 'success'],
                ['label' => 'O(n) — one scan total', 'next' => 'w_lin'],
            ],
        ],
        'w_lin' => [
            'message' => "Wrong.\n\nFinding n successive minima without fancy structures is quadratic.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'complex',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Each pass: min of suffix → swap into place\n- O(n²) time, O(1) space\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
