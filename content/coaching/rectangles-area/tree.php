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
            'message' => "Problem: A points table gives ids and coordinates. For each pair of points as opposite corners of an axis-aligned rectangle with non-zero area, report both ids and the area, ordered as the statement specifies. For instance, (2, 7) and (4, 8) give area 2. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin condition on ids?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p1.id < p2.id', 'next' => 's2'],
                ['label' => 'p1.id <> p2.id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each pair would appear twice.\nStep back to when you used <>.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Same x or same y?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Include', 'next' => 'wrong_b'],
                ['label' => 'Exclude (zero area)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement wants non-zero area.\nStep back to when you included them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Area formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ABS(dx) · ABS(dy)', 'next' => 'success'],
                ['label' => 'dx · dy', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Signs can make it negative.\nStep back to when you dropped ABS.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) pairs with positive area.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
