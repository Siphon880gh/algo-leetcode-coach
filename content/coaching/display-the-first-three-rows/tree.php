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
            'message' => "Read the problem statement above.\nWhich method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'head(3)', 'next' => 's2'],
                ['label' => 'tail(3)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. tail takes the last rows; the example → ids 60, 49, 43 instead of 3, 90, 9.\nStep back to when you used tail.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Slicing instead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'loc[:3]', 'next' => 'wrong_b'],
                ['label' => 'iloc[:3]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. loc includes the end label, so it returns 4 rows.\nStep back to when you used loc.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). The example → ids 3, 90, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
