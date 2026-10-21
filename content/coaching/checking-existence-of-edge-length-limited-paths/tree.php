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
            'message' => "Read the problem statement above.\nRun BFS per query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: offline sweep with DSU', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(Q · (V + E)).\nStep back to when you ran BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edge equal to the limit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Included', 'next' => 'wrong_b'],
                ['label' => 'Excluded (strictly less)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement uses strictly less than.\nStep back to when you included it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Original query order', 'next' => 'success'],
                ['label' => 'Sorted order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Store each answer at its original index.\nStep back to when you returned sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → [false,true], [true,false].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
