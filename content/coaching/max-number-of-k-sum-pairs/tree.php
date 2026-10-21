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
            'message' => "Read the problem statement above.\nReuse an element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: each is used once', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Removed numbers leave the array.\nStep back to when you reused it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "x = k − x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always pairs with itself', 'next' => 'wrong_b'],
                ['label' => 'Works: needs a second copy waiting', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One element cannot pair with itself.\nStep back to when you self-paired.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Alternative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort plus two pointers', 'next' => 'success'],
                ['label' => 'Check all pairs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. All pairs is O(n²).\nStep back to when you checked all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4], 5 → 2. [3,1,3,4,3], 6 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
