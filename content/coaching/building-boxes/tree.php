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
            'message' => "Read the problem statement above.\nWhere to stack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In a corner, as a stepped pyramid', 'next' => 's2'],
                ['label' => 'In the middle of the floor', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Walls count as support, so the corner needs the fewest floor boxes.\nStep back to when you used the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Boxes in a full k-layer corner pyramid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k²', 'next' => 'wrong_b'],
                ['label' => 'k(k + 1)(k + 2) / 6', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Layer i holds i(i + 1)/2 boxes; summing gives a tetrahedral number.\nStep back to when you used k².",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Leftover r boxes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add j floor boxes, smallest j with j(j + 1)/2 ≥ r', 'next' => 'success'],
                ['label' => 'Add r floor boxes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The j-th new floor box supports j − 1 more on top of it.\nStep back to when you added r.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n^(1/3)). Examples → 3, 3, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
