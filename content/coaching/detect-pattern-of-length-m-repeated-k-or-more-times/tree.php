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
            'message' => "Read the problem statement above.\nStreak target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm · (k − 1)', 'next' => 's2'],
                ['label' => 'm · k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The first copy needs no comparison.\nStep back to when you used m · k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Streak start aligned to m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: any start', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The pattern can begin anywhere.\nStep back to when you aligned it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mismatch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset the streak to 0', 'next' => 'success'],
                ['label' => 'Decrement it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Repetitions must be consecutive.\nStep back to when you decremented.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,4,4,4,4], 1, 3 → true. [1,2,1,2,1,3], 2, 3 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
