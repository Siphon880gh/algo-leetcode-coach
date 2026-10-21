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
            'message' => "Read the problem statement above.\nValue for cell (i, j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(r[i], c[j])', 'next' => 's2'],
                ['label' => 'r[i] / n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values must be integers and fit the column too.\nStep back to when you split evenly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why it finishes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Luck', 'next' => 'wrong_b'],
                ['label' => 'Each step zeroes a row or column; totals are equal', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal totals guarantee every sum reaches 0.\nStep back to when you doubted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Must match the sample output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any valid matrix', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Several matrices satisfy the sums.\nStep back to when you matched the sample.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). [3,8], [4,7] → [[3,0],[1,7]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
