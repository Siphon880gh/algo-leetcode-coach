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
            'message' => "Read the problem statement above.\nSquare sum cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1) from prefix sums', 'next' => 's2'],
                ['label' => 'Sum cells each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(k²) per square.\nStep back to when you summed cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Prefix formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'P[i+k][j+k] − P[i][j]', 'next' => 'wrong_b'],
                ['label' => 'P[i+k][j+k] − P[i][j+k] − P[i+k][j] + P[i][j]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both strips must be removed and the corner added back.\nStep back to when you subtracted one corner.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why binary search works?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values are non-negative', 'next' => 'success'],
                ['label' => 'The matrix is sorted', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Non-negative values mean a fitting side implies smaller sides fit.\nStep back to when you assumed sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · log min(m, n)). First example, threshold 4 → 2. All-2 grid, threshold 1 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
