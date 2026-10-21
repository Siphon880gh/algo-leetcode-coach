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
            'message' => "Problem: Given apple weights and a basket with a fixed total weight limit (set in the statement; 5000 in the usual version), return the most apples that fit. For instance, with a 5000 limit, [100,200,150,1000] fits all 4. (Restated from memory; limits and examples may differ slightly.)\nWhich apples first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The lightest', 'next' => 's2'],
                ['label' => 'The heaviest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The goal is the number of apples.\nStep back to when you took the heaviest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next apple does not fit. Skip it and continue?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: stop; later apples are heavier', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After sorting, none of the rest fit either.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Total equals the limit exactly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It fits', 'next' => 'success'],
                ['label' => 'It overflows', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The limit is inclusive.\nStep back to when you rejected it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Limit 5000, [100,200,150,1000] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
