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
            'message' => "Read the problem statement above.\nL = R gives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 selections', 'next' => 's2'],
                ['label' => '1 selection', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Both directions work: example 1 → 1 instead of 2.\nStep back to when you counted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "|L − R| = 1 gives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 selections', 'next' => 'wrong_b'],
                ['label' => '1 selection', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 0, 0] → 0 instead of 2.\nStep back to when you counted 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
