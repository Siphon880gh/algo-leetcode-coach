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
            'message' => "Read the problem statement above.\nWhat does swapping allow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any reordering', 'next' => 's2'],
                ['label' => 'Only adjacent changes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Repeated swaps reach every permutation.\nStep back to when you limited it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does relabelling allow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adding new letters', 'next' => 'wrong_b'],
                ['label' => 'Permuting counts among present letters', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both letters must already exist.\nStep back to when you added letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Equal letter sets and equal sorted counts', 'next' => 'success'],
                ['label' => 'Equal lengths only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 'a' and 'b' have equal lengths but differ.\nStep back to when you compared lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
