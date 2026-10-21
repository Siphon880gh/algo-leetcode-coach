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
            'message' => "Read the problem statement above.\nFirst check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same piece sequence without blanks', 'next' => 's2'],
                ['label' => 'Same counts of L and R', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Pieces cannot pass each other; Example 2 → true instead of false.\nStep back to when you compared counts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An L at i matched to j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Needs i ≤ j', 'next' => 'wrong_b'],
                ['label' => 'Needs i ≥ j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. L moves left only; Example 1 → false instead of true.\nStep back to when you reversed L.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "An R at i matched to j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Needs i ≤ j', 'next' => 'success'],
                ['label' => 'Any position', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. R moves right only; Example 3 → true instead of false.\nStep back to when you let R move anywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
