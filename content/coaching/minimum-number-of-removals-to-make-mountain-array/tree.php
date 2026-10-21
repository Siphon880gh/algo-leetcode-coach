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
            'message' => "Read the problem statement above.\nPeak at an end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not allowed: need L > 1 and R > 1', 'next' => 's2'],
                ['label' => 'Allowed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A mountain needs both slopes.\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Strict or non-strict?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Non-strict', 'next' => 'wrong_b'],
                ['label' => 'Strictly increasing and decreasing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal neighbours break a mountain.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L[i] + R[i] − 1', 'next' => 'success'],
                ['label' => 'L[i] + R[i]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The peak is counted twice.\nStep back to when you added both.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [1,3,1] → 0. [2,1,1,5,6,2,3,1] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
