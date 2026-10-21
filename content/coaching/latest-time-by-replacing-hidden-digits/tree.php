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
            'message' => "Read the problem statement above.\nHour tens ? with units 7?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 's2'],
                ['label' => '2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 27 is not a valid hour.\nStep back to when you chose 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Hour units ? after a 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '9', 'next' => 'wrong_b'],
                ['label' => '3', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Hours stop at 23.\nStep back to when you chose 9.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Both hour digits hidden?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '23', 'next' => 'success'],
                ['label' => '29', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Fill the tens first (2), then the units (3).\nStep back to when you wrote 29.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 23:50, 09:39, 19:22.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
