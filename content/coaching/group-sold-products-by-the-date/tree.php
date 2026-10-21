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
            'message' => "Read the problem statement above.\nCount which?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(DISTINCT product)', 'next' => 's2'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Mask appears twice on 2020-06-02.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order inside the list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insertion order', 'next' => 'wrong_b'],
                ['label' => 'Lexicographic', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement sorts the names.\nStep back to when you kept insertion order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By sell_date', 'next' => 'success'],
                ['label' => 'By num_sold', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rows are ordered by date.\nStep back to when you ordered by count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. 2020-05-30 → 3, \"Basketball,Headphone,T-Shirt\". 2020-06-02 → 1, \"Mask\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
