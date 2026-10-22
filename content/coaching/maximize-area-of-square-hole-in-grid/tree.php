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
            'message' => "Read the problem statement above.\nGap from removing L consecutive bars?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L + 1', 'next' => 's2'],
                ['label' => 'L', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Removing one bar joins two cells; examples → 1, 1, 1 instead of 4, 4, 4.\nStep back to when you used L.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Area?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Product of the gaps', 'next' => 'wrong_b'],
                ['label' => 'Smaller gap squared', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The hole must be square; example 1 → 6 instead of 4.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(h log h + v log v). Examples → 4, 4, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
