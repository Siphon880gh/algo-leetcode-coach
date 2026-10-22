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
            'message' => "Read the problem statement above.\nChoose column values how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over columns', 'next' => 's2'],
                ['label' => 'Cheapest value per column, different from the previous', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[0, 1, 1], [0, 1, 1], [0, 0, 1]] → 4 instead of 3.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Transition from u to v?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any u', 'next' => 'wrong_b'],
                ['label' => 'Only u ≠ v', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Neighbouring columns must differ: [[1, 1], [1, 1]] → 0 instead of 2.\nStep back to when you allowed u = v.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n + 100 n). Examples → 0, 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
