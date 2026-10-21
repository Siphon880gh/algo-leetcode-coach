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
            'message' => "Problem: Given three strictly increasing arrays, return the sorted values found in all three. For instance, [1,2,3,4], [1,3,5], and [1,3,9] give [1,3]. (Restated from memory; limits and examples may differ slightly.)\nValues differ. Advance which?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The pointer at the smallest value', 'next' => 's2'],
                ['label' => 'All three', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You could skip a match.\nStep back to when you advanced all.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "All three equal. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Advance one', 'next' => 'wrong_b'],
                ['label' => 'Record it and advance all three', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The value is used up in every array.\nStep back to when you advanced one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Need sorting at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: matches come in increasing order', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The scan is already in order.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n1 + n2 + n3). [1,2,3,4], [1,3,5], [1,3,9] → [1,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
