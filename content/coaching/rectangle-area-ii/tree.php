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
            'message' => "Read the problem statement above.\nAdd the areas and subtract pairwise overlaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compress coordinates and mark cells', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Triple overlaps break inclusion–exclusion with pairs only.\nStep back to when you subtracted pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the area of compressed cell (i, j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '(xs[i + 1] − xs[i]) · (ys[j + 1] − ys[j])', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Compressed cells have their real widths and heights.\nStep back to when you counted cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Areas reach 10¹⁸. How do you sum them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In 64-bit (or big integers), taking mod 10⁹ + 7', 'next' => 'success'],
                ['label' => 'In 32-bit, then mod', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A single area can overflow 32 bits.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). [[0,0,2,2],[1,0,2,3],[1,0,3,1]] → 6. [[0,0,1000000000,1000000000]] → 49.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
