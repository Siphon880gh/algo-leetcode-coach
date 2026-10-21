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
            'message' => "Read the problem statement above.\nPairing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest with largest', 'next' => 's2'],
                ['label' => 'Adjacent elements after sorting', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two large neighbours make a big sum.\nStep back to when you paired neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sum of all pairs', 'next' => 'wrong_b'],
                ['label' => 'The max over the pairs', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. We minimise the largest pair sum.\nStep back to when you summed them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pairs to check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n / 2', 'next' => 'success'],
                ['label' => 'n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each element is in one pair.\nStep back to when you looped n times.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 7, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
