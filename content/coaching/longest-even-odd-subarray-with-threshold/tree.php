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
            'message' => "Read the problem statement above.\nA valid start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Even and at most threshold', 'next' => 's2'],
                ['label' => 'Any value at most threshold', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The first element must be even; example 1 → 4 instead of 3.\nStep back to when you allowed odd starts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extend while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Parity alternates', 'next' => 'wrong_b'],
                ['label' => 'Parity alternates and the value is at most threshold', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every element must fit; example 3 → 4 instead of 3.\nStep back to when you skipped the threshold.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 3, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
