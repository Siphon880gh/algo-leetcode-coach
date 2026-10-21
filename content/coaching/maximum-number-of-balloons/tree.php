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
            'message' => "Read the problem statement above.\nRemove \"balloon\" letters in a loop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one letter count', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counting once is enough.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "l and o counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use as is', 'next' => 'wrong_b'],
                ['label' => 'Divide by 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each word needs two of each.\nStep back to when you used the raw counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Minimum over the five letters', 'next' => 'success'],
                ['label' => 'Sum', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The scarcest letter limits the words.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"nlaebolko\" → 1. \"loonbalxballpoon\" → 2. \"leetcode\" → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
