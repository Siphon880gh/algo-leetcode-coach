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
            'message' => "Read the problem statement above.\nLeading zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip them', 'next' => 's2'],
                ['label' => 'Treat them as digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. l = 10, r = 100 → 91 instead of 16.\nStep back to when you multiplied by leading zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f(r) − f(l)', 'next' => 'wrong_b'],
                ['label' => 'f(r) − f(l − 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 2.\nStep back to when you dropped l.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Fast digit DP. Examples → 2, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
