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
            'message' => "Read the problem statement above.\nY and background values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Must differ', 'next' => 's2'],
                ['label' => 'May be equal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 11 instead of 12.\nStep back to when you allowed equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Vertical stroke?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole centre column', 'next' => 'wrong_b'],
                ['label' => 'Centre column from the centre down', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 10 instead of 12.\nStep back to when you used the whole column.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 3, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
