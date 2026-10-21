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
            'message' => "Read the problem statement above.\nDo you need to simulate a path on a grid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only the net displacement matters', 'next' => 's2'],
                ['label' => 'Yes: store each visited cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Where it went in between does not matter; only where it ends.\nStep back to when you stored cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What must hold at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The total number of moves is even', 'next' => 'wrong_b'],
                ['label' => 'count(U) == count(D) and count(L) == count(R)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"UU\" is even and does not return.\nStep back to when you checked parity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can you combine the two axes into one counter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep x and y separate', 'next' => 'success'],
                ['label' => 'Yes: U and R add 1, D and L subtract 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. \"UL\" would sum to 0 but ends at (−1, 1).\nStep back to when you merged the axes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Track x and y: O(n). \"UD\" → true. \"LL\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
