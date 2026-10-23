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
            'message' => "Read the problem statement above.\nEdge inside one component?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add it if pu ⊕ pv = w', 'next' => 's2'],
                ['label' => 'Always reject it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 2 instead of 3.\nStep back to when you rejected every cycle.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Joining two roots: root parity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'w', 'next' => 'wrong_b'],
                ['label' => 'pu ⊕ pv ⊕ w', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): n = 3, [[0, 1, 1], [0, 2, 1], [1, 2, 1]] → 3 instead of 2.\nStep back to when you dropped pu and pv.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m α(n)). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
