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
            'message' => "Read the problem statement above.\nSecondary diagonal index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'mat[i][n − 1 − i]', 'next' => 's2'],
                ['label' => 'mat[i][n − i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is off by one.\nStep back to when you indexed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave it', 'next' => 'wrong_b'],
                ['label' => 'Subtract the centre once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The centre lies on both diagonals.\nStep back to when you left it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Need nested loops?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one pass over rows', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only 2n cells matter.\nStep back to when you scanned all cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Example 1 → 25. All-ones 4 × 4 → 8. [[5]] → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
