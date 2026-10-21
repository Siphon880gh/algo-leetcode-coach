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
            'message' => "Read the problem statement above.\nAt a common value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both sums = max + v', 'next' => 's2'],
                ['label' => 'Add v to each separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You can switch to the better path.\nStep back to when you kept them separate.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Modulo when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After every addition', 'next' => 'wrong_b'],
                ['label' => 'Only at the end', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reducing early breaks the max comparison.\nStep back to when you reduced early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Remaining tail?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add it to its own sum', 'next' => 'success'],
                ['label' => 'Drop it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The path continues to the end.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 30, 109, 40.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
