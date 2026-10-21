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
            'message' => "Read the problem statement above.\nGenerate and sort all fractions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: binary search the value', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n² log n).\nStep back to when you sorted all fractions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For a guess x, how do you count fractions ≤ x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check every pair', 'next' => 'wrong_b'],
                ['label' => 'Two pointers: as the denominator grows, the valid numerator prefix only grows', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The monotone prefix makes counting O(n).\nStep back to when you checked every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "count(x) == k. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest fraction counted, tracked during the sweep', 'next' => 'success'],
                ['label' => 'x itself', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. x is a real threshold, not one of the fractions.\nStep back to when you returned x.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log(1/ε)). [1,2,3,5], k = 3 → [2,5]. [1,7], k = 1 → [1,7].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
