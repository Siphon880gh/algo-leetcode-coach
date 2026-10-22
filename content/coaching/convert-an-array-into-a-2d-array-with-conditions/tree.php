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
            'message' => "Read the problem statement above.\nHow many rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The highest frequency', 'next' => 's2'],
                ['label' => 'The number of distinct values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is not minimal; Example 1 → 4 rows instead of 3.\nStep back to when you counted distinct values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does a copy go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last row, or a new one if x is there', 'next' => 'wrong_b'],
                ['label' => 'Row seen[x], its copy number', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Earlier rows may still have room; nums = [1,1,2,2] → 3 rows instead of 2.\nStep back to when you used the last row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [[1,3,4,2],[1,3],[1]], [[1,2,3,4]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
