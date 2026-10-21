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
            'message' => "Read the problem statement above.\nOdd number of ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Alice wins', 'next' => 's2'],
                ['label' => 'Bob wins', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Alice makes the final move and can unbalance it.\nStep back to when you gave it to Bob.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two ? on the same side contribute?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '9 in total under Bob\'s mirroring', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Bob answers x with 9 − x on that side.\nStep back to when you cancelled them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Search the game tree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not needed', 'next' => 'success'],
                ['label' => 'Required', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The closed form decides it.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → false, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
