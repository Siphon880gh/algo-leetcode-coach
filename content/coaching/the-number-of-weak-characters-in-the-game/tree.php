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
            'message' => "Read the problem statement above.\nTie order for equal attack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Defense ascending', 'next' => 's2'],
                ['label' => 'Defense descending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Then [2,3] raises the maximum before [2,2] and [2,2] is wrongly counted weak.\nStep back to when you sorted defense descending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Weak test during the scan?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'defense ≤ max defense so far', 'next' => 'wrong_b'],
                ['label' => 'defense < max defense so far', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both attributes must be strictly greater; [[3,3],[2,3]] → 0.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Check every pair instead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, 10^5 characters', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is about 10^10 comparisons.\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 0, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
