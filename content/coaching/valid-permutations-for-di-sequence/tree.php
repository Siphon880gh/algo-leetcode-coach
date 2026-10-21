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
            'message' => "Read the problem statement above.\nTrack the actual values placed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only the rank of the last one among those placed', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only relative order matters for future I/D checks.\nStep back to when you tracked values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"I\" with new last rank j. Previous last rank k must be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k ≥ j', 'next' => 'wrong_b'],
                ['label' => 'k < j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the D case.\nStep back to when you used k ≥ j.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you avoid an O(n³) DP?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums over the previous row', 'next' => 'success'],
                ['label' => 'Memoize each cell', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each cell still sums O(n) values without prefix sums.\nStep back to when you only memoized.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). \"DID\" → 5. \"D\" → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
