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
            'message' => "Read the problem statement above.\nright for a group of count c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − left − c', 'next' => 's2'],
                ['label' => 'n − left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The group itself is counted on its own right; Example 1 → 22 instead of 3.\nStep back to when you kept c on the right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A triplet counts when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Neighbours differ: nums[i] ≠ nums[j] and nums[j] ≠ nums[k]', 'next' => 'wrong_b'],
                ['label' => 'All three values differ', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [4,2,4] slips through; Example 1 → 5 instead of 3.\nStep back to when you checked only neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
