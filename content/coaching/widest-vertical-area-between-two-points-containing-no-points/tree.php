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
            'message' => "Read the problem statement above.\nDoes y matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Vertical areas span all y.\nStep back to when you used y.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After sorting x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max − min', 'next' => 'wrong_b'],
                ['label' => 'Max of adjacent differences', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Points in between split the area.\nStep back to when you used the full span.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal x values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Gap 0, harmless', 'next' => 'success'],
                ['label' => 'Must deduplicate first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A zero gap never wins.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
