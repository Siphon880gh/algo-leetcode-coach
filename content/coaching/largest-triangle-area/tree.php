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
            'message' => "Read the problem statement above.\nIs O(n³) acceptable?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: n ≤ 50, about 20,000 triples', 'next' => 's2'],
                ['label' => 'No, use a convex hull', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The hull helps for large n, but brute force fits these limits.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you compute the area?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Heron\'s formula', 'next' => 'wrong_b'],
                ['label' => '|cross(q − p, r − p)| / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Heron works but needs square roots and loses precision on thin triangles.\nStep back to when you used Heron.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why the absolute value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cross product is negative for clockwise point orders', 'next' => 'success'],
                ['label' => 'It is not needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without it, some triangles would score negative areas.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). [[0,0],[0,1],[1,0],[0,2],[2,0]] → 2.0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
