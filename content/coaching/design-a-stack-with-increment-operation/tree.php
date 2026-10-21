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
            'message' => "Read the problem statement above.\nincrement(k, v) cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1) with a lazy array', 'next' => 's2'],
                ['label' => 'Loop over k elements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(k) per call.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On pop, the increment goes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Discarded', 'next' => 'wrong_b'],
                ['label' => 'Added to the value and passed down', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Elements below share it.\nStep back to when you discarded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Push when full?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'success'],
                ['label' => 'Grow the stack', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. maxSize is a hard limit.\nStep back to when you grew it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Example → pops 2, then 103, 202, 201, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
