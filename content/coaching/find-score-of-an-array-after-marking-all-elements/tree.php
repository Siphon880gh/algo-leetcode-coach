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
            'message' => "Read the problem statement above.\nEqual values: which first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smaller index', 'next' => 's2'],
                ['label' => 'The larger index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The rule picks the smallest index; nums = [1,1,2] → 1 instead of 3.\nStep back to when you took the larger index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The next element is already marked?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add it anyway', 'next' => 'wrong_b'],
                ['label' => 'Skip it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Marked elements are never chosen; Example 1 → 17 instead of 7.\nStep back to when you added marked elements.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 7, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
