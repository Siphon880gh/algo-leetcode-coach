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
            'message' => "Read the problem statement above.\nGraph nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The start and each road’s end', 'next' => 's2'],
                ['label' => 'Every lattice point in the rectangle', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Coordinates reach 10^5, so that is up to 10^10 points instead of at most 201 nodes.\nStep back to when you used the grid.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The answer is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walking straight from the start', 'next' => 'wrong_b'],
                ['label' => 'min over nodes of D[u] + distance to target', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Roads can be cheaper; Example 1 → 7 instead of 5.\nStep back to when you ignored the roads.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(r²). Examples → 5, 7, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
