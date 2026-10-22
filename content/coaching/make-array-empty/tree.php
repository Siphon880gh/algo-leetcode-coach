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
            'message' => "Read the problem statement above.\nAdd a wrap when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p[i] < p[i − 1]', 'next' => 's2'],
                ['label' => 'p[i] > p[i − 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Moving right needs no wrap; Example 3 → 6 instead of 3.\nStep back to when you flipped the test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A wrap costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n', 'next' => 'wrong_b'],
                ['label' => 'n − i, the elements left', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Removed elements are not rotated again; Example 1 → 6 instead of 5.\nStep back to when you added n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 5, 5, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
