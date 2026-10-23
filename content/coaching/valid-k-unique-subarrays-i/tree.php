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
            'message' => "Read the problem statement above.\nHash each value with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A random 64-bit number', 'next' => 's2'],
                ['label' => 'The value itself', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): nums = [1, 2, 3], k = 3, query [0, 2] → true instead of false.\nStep back to when you XOR-ed the values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distinct count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least k', 'next' => 'wrong_b'],
                ['label' => 'Exactly k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): nums = [2, 2, 2, 3, 3], k = 1, query [1, 4] → true instead of false.\nStep back to when you allowed more than k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [false, true, false], [true, false].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
