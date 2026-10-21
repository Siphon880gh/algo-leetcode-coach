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
            'message' => "Read the problem statement above.\nTry every pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: split the score by index', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you tried every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you carry across j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest value so far', 'next' => 'wrong_b'],
                ['label' => 'The best values[i] + i for i < j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The index changes the score.\nStep back to when you carried the largest value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Update the best start before or after scoring j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After', 'next' => 'success'],
                ['label' => 'Before', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. j would pair with itself.\nStep back to when you updated first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [8,1,5,2,6] → 11. [1,2] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
