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
            'message' => "Read the problem statement above.\nSegment break?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When nums[r] > nums[r + 1]', 'next' => 's2'],
                ['label' => 'When nums[r] ≥ nums[r + 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2, query [0, 1] → 2 instead of 3.\nStep back to when you broke on equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "End segments?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count them whole', 'next' => 'wrong_b'],
                ['label' => 'Cut them at l and r', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1, query [0, 1] → 4 instead of 2.\nStep back to when you kept whole segments.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [2, 3, 4], [3, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
