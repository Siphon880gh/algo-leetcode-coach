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
            'message' => "Read the problem statement above.\nDoes Alice's removal change Bob's options?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Removing an A from inside an A-run never touches a B-run.\nStep back to when you linked the two.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Moves available to Alice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Number of A-runs of length ≥ 3', 'next' => 'wrong_b'],
                ['label' => 'Interior positions of A-runs of length ≥ 3', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. AAAA gives two moves, not one.\nStep back to when you counted runs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal move counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bob wins', 'next' => 'success'],
                ['label' => 'Alice wins', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Alice moves first, so she runs out first.\nStep back to when you gave her the tie.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
