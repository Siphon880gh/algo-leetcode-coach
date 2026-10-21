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
            'message' => "Read the problem statement above.\nWhat can repeated flips achieve?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move a minus sign anywhere; pairs cancel', 'next' => 's2'],
                ['label' => 'Flip any single cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each operation flips two cells, so the parity of negatives never changes.\nStep back to when you flipped one cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd number of negatives. Which stays negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The originally smallest number', 'next' => 'wrong_b'],
                ['label' => 'The smallest absolute value', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In [[-5,1],[1,1]] the raw minimum is -5, but a 1 should carry the sign: 6, not -2.\nStep back to when you used the raw minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A zero in the grid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Formula already works: min |x| = 0', 'next' => 'success'],
                ['label' => 'Special case needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Subtracting 2 · 0 changes nothing, which is right.\nStep back to when you added a special case.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 4, 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
