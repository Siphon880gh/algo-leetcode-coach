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
            'message' => "Read the problem statement above.\nCount every value in the range per query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: get one candidate, then verify', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 10⁴ queries over 2 · 10⁴ elements is too slow.\nStep back to when you counted all values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Merge (a, x) with (b, y), a ≠ b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep a with x + y', 'next' => 'wrong_b'],
                ['label' => 'Larger count wins with |x − y|', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Different candidates cancel.\nStep back to when you added counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Candidate found. Return it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only if bisect count ≥ threshold', 'next' => 'success'],
                ['label' => 'Yes, always', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The vote only gives the possible majority.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) per query. [1,1,2,2,1,1]: query(0,5,4) → 1, query(0,3,3) → −1, query(2,3,2) → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
