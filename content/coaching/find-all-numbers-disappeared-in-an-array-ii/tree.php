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
            'message' => "Read the problem statement above.\nAfter the last value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add [prev + 1, upper] if needed', 'next' => 's2'],
                ['label' => 'Stop', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [[1, 2], [4, 6], [8, 8]].\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Values below lower?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use them as prev', 'next' => 'wrong_b'],
                ['label' => 'Skip them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [[2, 7]] instead of [[5, 7]].\nStep back to when you used them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [[1, 2], [4, 6], [8, 8], [10, 12]], [[5, 7]], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
