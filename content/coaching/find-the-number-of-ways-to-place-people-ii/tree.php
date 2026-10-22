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
            'message' => "Read the problem statement above.\nTest every third point per pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, sweep', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 1,000 gives about 10^9 checks.\nStep back to when you tested each third point.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count B when its y is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least the last counted y', 'next' => 'wrong_b'],
                ['label' => 'Strictly above the last counted y', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal heights block: [[0, 5], [1, 2], [2, 2]] → 3 instead of 2.\nStep back to when you allowed equal.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 0, 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
