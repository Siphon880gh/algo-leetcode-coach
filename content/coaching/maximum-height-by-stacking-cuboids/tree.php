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
            'message' => "Read the problem statement above.\nWhich side is the height?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest dimension', 'next' => 's2'],
                ['label' => 'Try all rotations in the DP', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorted dimensions with the largest on top are always optimal.\nStep back to when you tried all rotations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fit condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only base area smaller', 'next' => 'wrong_b'],
                ['label' => 'All three sorted dimensions ≤', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each dimension must fit.\nStep back to when you compared areas.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order before DP?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort cuboids by their sorted dimensions', 'next' => 'success'],
                ['label' => 'Any order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A cuboid must come after every one that can sit under it.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 190, 76, 102.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
