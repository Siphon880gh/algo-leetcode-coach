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
            'message' => "Read the problem statement above.\ngather picks which row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The leftmost with enough free seats', 'next' => 's2'],
                ['label' => 'The one with the most free seats', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 2, m = 5: gather(1, 1) twice → [0,0], [1,0] instead of [0,0], [0,1].\nStep back to when you took the emptiest row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "scatter without enough seats?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fill rows and report failure at the end', 'next' => 'wrong_b'],
                ['label' => 'Check the total first and book nothing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last scatter in the example would take the final seat, so a later gather(1, 1) → [] instead of [1,4].\nStep back to when you filled before checking.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width for the free totals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 5 · 10^4 rows of 10^9 seats total 5 · 10^13.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) per call, amortised. Example → [0,0], [], true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
