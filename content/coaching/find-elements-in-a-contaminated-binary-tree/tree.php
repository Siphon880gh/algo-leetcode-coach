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
            'message' => "Read the problem statement above.\nRoot value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 's2'],
                ['label' => '−1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Recovery starts at 0.\nStep back to when you kept −1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Right child of x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2x + 1', 'next' => 'wrong_b'],
                ['label' => '2x + 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 2x + 1 is the left child.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer find(t)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Look t up in the set', 'next' => 'success'],
                ['label' => 'Search the tree each time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A set gives O(1) per query.\nStep back to when you searched the tree.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) build, O(1) find. [-1,null,-1]: find 1 → false, find 2 → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
