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
            'message' => "Read the problem statement above.\nWhat is the shortest possible length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'kⁿ + n − 1: every code once, overlapping maximally', 'next' => 's2'],
                ['label' => 'kⁿ · n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Codes can overlap in n − 1 digits.\nStep back to when you concatenated codes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What are the graph nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The n-digit codes', 'next' => 'wrong_b'],
                ['label' => 'The (n − 1)-digit strings', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Making codes the edges turns the problem into an Eulerian circuit.\nStep back to when you used codes as nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why not a simple greedy walk adding any unused code?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It can get stuck; Hierholzer\'s DFS appends digits on the way back', 'next' => 'success'],
                ['label' => 'Greedy always works', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A naive greedy walk can dead-end before all codes are used.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Hierholzer over kⁿ edges. n = 1, k = 2 → \"10\" (or \"01\"). n = 2, k = 2 → \"01100\" (or another valid answer).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
