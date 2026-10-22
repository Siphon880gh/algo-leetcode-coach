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
            'message' => "Read the problem statement above.\nx = y?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No extra piece', 'next' => 's2'],
                ['label' => 'Still add one extra', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An extra piece would sit next to its twin and make AAA or BBB; x = y = 2, z = 1 → 12 instead of 10.\nStep back to when you added the extra.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many AB pieces fit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most one', 'next' => 'wrong_b'],
                ['label' => 'All of them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. AB pieces chain as ABAB…; example 2 → 12 instead of 14.\nStep back to when you used one AB.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 12, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
