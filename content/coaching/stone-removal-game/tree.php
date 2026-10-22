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
            'message' => "Read the problem statement above.\nAlice wins when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Simulate the takes', 'next' => 's2'],
                ['label' => 'n ≥ 10', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 19 → true instead of false.\nStep back to when you checked n ≥ 10.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always 10', 'next' => 'wrong_b'],
                ['label' => 'One less than the previous', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 19 → true instead of false.\nStep back to when you kept 10.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
