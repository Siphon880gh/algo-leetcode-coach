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
            'message' => "Read the problem statement above.\nCheck every pair (i, j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: split by sign pattern', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) for 40000 elements.\nStep back to when you checked pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many patterns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Eight, including the sign of i', 'next' => 'wrong_b'],
                ['label' => 'Four: (±1, ±1) on arr1 and arr2, plus i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Flipping every sign gives the same max minus min.\nStep back to when you counted eight.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "For one pattern, value per index is v. Contribution?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(v) − min(v)', 'next' => 'success'],
                ['label' => 'max(v)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The expression is a difference of two indices.\nStep back to when you took only the max.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4], [−1,4,5,6] → 13. [1,−2,−5,0,10], [0,−2,−1,−7,−4] → 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
