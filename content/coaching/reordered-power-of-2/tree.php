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
            'message' => "Read the problem statement above.\nTry every permutation of the digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare digit counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ten digits have millions of orderings.\nStep back to when you permuted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which powers do you check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only those with the same first digit', 'next' => 'wrong_b'],
                ['label' => '2⁰ through 2²⁹', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The reordering can put any digit first.\nStep back to when you matched the first digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What about leading zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No issue: a power of two has none, so its order is valid', 'next' => 'success'],
                ['label' => 'Reject any n with a 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 0 can sit anywhere but the front, and the matching power shows such an order.\nStep back to when you rejected zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(30 · d). 1 → true. 10 → false. 46 → true (64).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
