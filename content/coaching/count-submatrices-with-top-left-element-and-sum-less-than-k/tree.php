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
            'message' => "Read the problem statement above.\nWhich submatrices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those containing the top-left cell', 'next' => 's2'],
                ['label' => 'All submatrices', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 16 instead of 4.\nStep back to when you counted all.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum per corner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add the rectangle cell by cell', 'next' => 'wrong_b'],
                ['label' => 'One prefix-sum step', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. At 1,000 × 1,000 that is about 2.5 · 10^11 additions.\nStep back to when you summed cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n). Examples → 4, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
