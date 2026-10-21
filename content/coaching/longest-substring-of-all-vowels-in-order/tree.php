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
            'message' => "Read the problem statement above.\nOn w[i] < w[i − 1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start a new run at i with one stage', 'next' => 's2'],
                ['label' => 'Keep the run going', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A decrease breaks sorted order.\nStep back to when you kept the run.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On w[i] > w[i − 1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset the run', 'next' => 'wrong_b'],
                ['label' => 'Add one stage', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A rise is the next vowel in order.\nStep back to when you reset on a rise.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When to record?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whenever stages == 5', 'next' => 'success'],
                ['label' => 'At every index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A run must contain all five vowels to count.\nStep back to when you recorded every index.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 13, 5, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
