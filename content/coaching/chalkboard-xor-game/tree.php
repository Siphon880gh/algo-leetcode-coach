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
            'message' => "Read the problem statement above.\nSearch the game tree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a parity argument settles it', 'next' => 's2'],
                ['label' => 'Yes, with memoization', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The state space is exponential.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The XOR starts at 0. Who wins?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It depends on n', 'next' => 'wrong_b'],
                ['label' => 'Alice, immediately', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A player starting a turn with XOR 0 wins.\nStep back to when you checked n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Even count, nonzero XOR X. Why does Alice have a safe move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'If every move lost, every number would equal X, and an even number of copies of X XOR to 0', 'next' => 'success'],
                ['label' => 'She does not', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The contradiction proves a safe move exists.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,1,2] → false. [0,1] → true. [1,2,3] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
