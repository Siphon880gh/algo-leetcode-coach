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
            'message' => "Read the problem statement above.\nEqual neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Break both runs', 'next' => 's2'],
                ['label' => 'Extend them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 4 instead of 1.\nStep back to when you allowed equals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Runs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One run of any change', 'next' => 'wrong_b'],
                ['label' => 'Increasing and decreasing separately', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zigzags count: example 1 → 3 instead of 2.\nStep back to when you merged the runs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
