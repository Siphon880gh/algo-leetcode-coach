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
            'message' => "Read the problem statement above.\nWhich points does the fence touch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The convex hull, including points that lie on its edges', 'next' => 's2'],
                ['label' => 'Only the corner points of the convex hull', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A tree exactly on a fence edge is also on the perimeter and must be returned.\nStep back to when you kept only corners.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Monotone chain: when do you pop the stack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whenever cross <= 0', 'next' => 'wrong_b'],
                ['label' => 'Only on a strict right turn: cross < 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Popping on cross == 0 removes the collinear trees on an edge.\nStep back to when you popped on zero.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You have the lower and upper hulls. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge them and remove duplicate points', 'next' => 'success'],
                ['label' => 'Concatenate them as they are', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The endpoints appear in both, and when every point is collinear both passes return the same points.\nStep back to when you concatenated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort, two chains with cross < 0 pops, and deduplicate: O(n log n) time.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
