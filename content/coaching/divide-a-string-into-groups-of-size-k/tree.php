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
            'message' => "Read the problem statement above.\nCut from which end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the left, k at a time', 'next' => 's2'],
                ['label' => 'From the right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 2 → [abc,def,ghi,jxx], so the short group is last.\nStep back to when you cut from the right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which groups get fill?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every group', 'next' => 'wrong_b'],
                ['label' => 'Only the last, if it is short', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Full groups stay as they are.\nStep back to when you padded every group.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many fill characters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As many as needed to reach k', 'next' => 'success'],
                ['label' => 'Exactly one', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. j becomes jxx with k = 3.\nStep back to when you added one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [abc,def,ghi], [abc,def,ghi,jxx].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
