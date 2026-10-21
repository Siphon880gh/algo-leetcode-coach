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
            'message' => "Read the problem statement above.\nIndex base for left/right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1-indexed', 'next' => 's2'],
                ['label' => '0-indexed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement counts from 1.\nStep back to when you used 0-based.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sums fit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Too many', 'next' => 'wrong_b'],
                ['label' => 'n ≤ 1000: about 5·10^5 sums', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sorting half a million values is fine.\nStep back to when you dismissed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On the final range sum', 'next' => 'success'],
                ['label' => 'On each subarray sum before sorting', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Taking mod first breaks the ordering.\nStep back to when you reduced early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log n). [1,2,3,4]: (1,5) → 13; (3,4) → 6; (1,10) → 50.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
