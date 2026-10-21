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
            'message' => "Read the problem statement above.\nPositive n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before the first digit < x', 'next' => 's2'],
                ['label' => 'Before the first digit > x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That makes the number smaller.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Negative n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before the first digit < x', 'next' => 'wrong_b'],
                ['label' => 'Before the first digit > x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Smaller magnitude is larger for negatives.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No such digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append x', 'next' => 'success'],
                ['label' => 'Prepend x', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every digit already beats x, so x belongs at the end.\nStep back to when you prepended.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"999\", \"-123\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
