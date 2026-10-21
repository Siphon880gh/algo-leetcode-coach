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
            'message' => "Read the problem statement above.\nWhat matters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total count of each letter', 'next' => 's2'],
                ['label' => 'Each word\'s own letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Characters move freely between words.\nStep back to when you checked words separately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total length divisible by len(words)', 'next' => 'wrong_b'],
                ['label' => 'Every count divisible by len(words)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each letter must split evenly.\nStep back to when you checked only the length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always true', 'next' => 'success'],
                ['label' => 'Check its letters', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any count divides by 1.\nStep back to when you checked.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
