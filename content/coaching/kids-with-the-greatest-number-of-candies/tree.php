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
            'message' => "Read the problem statement above.\nMax per kid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compute once', 'next' => 's2'],
                ['label' => 'Recompute per kid', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) for no reason.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie with the max?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Does not (>)', 'next' => 'wrong_b'],
                ['label' => 'Counts (≥)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Tying the max is still greatest.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Give extras to others too?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one kid at a time', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each check gives all extras to that kid only.\nStep back to when you shared them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,3,5,1,3], 3 → [true,true,true,false,true]. [12,1,12], 10 → [true,false,true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
