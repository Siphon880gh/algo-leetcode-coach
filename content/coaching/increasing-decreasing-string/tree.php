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
            'message' => "Read the problem statement above.\nCopies per sweep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One per letter', 'next' => 's2'],
                ['label' => 'All of them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each sweep takes a letter once.\nStep back to when you took all copies.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the upward sweep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sweep a to z again', 'next' => 'wrong_b'],
                ['label' => 'Sweep z to a', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The pattern alternates direction.\nStep back to when you repeated the direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort once instead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sorting gives only increasing order.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. \"aaaabbbbcccc\" → \"abccbaabccba\". \"rat\" → \"art\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
