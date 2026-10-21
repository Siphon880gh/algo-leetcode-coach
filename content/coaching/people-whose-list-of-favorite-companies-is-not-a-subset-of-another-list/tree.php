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
            'message' => "Read the problem statement above.\nCompare as lists?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sets: order does not matter', 'next' => 's2'],
                ['label' => 'Sequences', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [a, b] and [b, a] are the same set.\nStep back to when you compared sequences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare with itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Include it', 'next' => 'wrong_b'],
                ['label' => 'Skip j = i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every set is a subset of itself.\nStep back to when you included j = i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing index', 'next' => 'success'],
                ['label' => 'Any', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for increasing order.\nStep back to when you left it unordered.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example 1 → [0,1,4]. Example 2 → [0,1]. Example 3 → [0,1,2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
