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
            'message' => "Read the problem statement above.\nReverse the list first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The head is already the top bit.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'v = v + bit · 2', 'next' => 'wrong_b'],
                ['label' => 'v = v · 2 + bit', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Earlier bits must shift left.\nStep back to when you scaled the bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Start value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => '1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Starting at 1 adds a phantom top bit.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,0,1] → 5. [0] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
