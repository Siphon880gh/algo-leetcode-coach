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
            'message' => "Read the problem statement above.\nCheck the sides p1–p2–p3–p4 in input order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the points can come in any order, so use all six pairs', 'next' => 's2'],
                ['label' => 'Yes: walk the points around', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The input does not have to list the points around the shape, so p1–p2 might be a diagonal.\nStep back to when you trusted the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What should the six squared distances look like?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Four equal values are enough', 'next' => 'wrong_b'],
                ['label' => 'Two distinct values: four equal sides and two equal diagonals', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A rhombus also has four equal sides; the equal diagonals are what make it a square.\nStep back to when you checked only the sides.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Anything else to rule out?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A zero side: duplicate points cannot form a square', 'next' => 'success'],
                ['label' => 'No, that is all', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Duplicate points make some distances 0, and a square needs a real side length; checking that the side is non-zero rules them out in one step.\nStep back to when you skipped the zero check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Six squared distances: four equal non-zero sides and two equal diagonals: O(1) time.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
