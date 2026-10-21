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
            'message' => "Read the problem statement above.\nGenerate every permutation, then check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: prune when the new pair is not a square', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Most branches fail early.\nStep back to when you checked only at the end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you avoid counting equal permutations twice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Collect the results in a set at the end', 'next' => 'wrong_b'],
                ['label' => 'Sort, and skip a value equal to the previous one when that one is unused', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The duplicate work is already done by then.\nStep back to when you used a set.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you test a perfect square?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r = isqrt(s), check r · r == s', 'next' => 'success'],
                ['label' => 'sqrt(s) is an integer as a float', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Floats can round wrong.\nStep back to when you used float sqrt.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n!) worst case. [1,17,8] → 2. [2,2,2] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
