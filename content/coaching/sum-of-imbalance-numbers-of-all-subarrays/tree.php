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
            'message' => "Read the problem statement above.\nA value already in the set appears?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 's2'],
                ['label' => 'Count it again', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A repeat changes no gaps; example 2 → 20 instead of 8.\nStep back to when you counted repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The imbalance of a subarray is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Components', 'next' => 'wrong_b'],
                ['label' => 'Components − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One block has no gaps; example 1 → 13 instead of 3.\nStep back to when you used the component count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 3, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
