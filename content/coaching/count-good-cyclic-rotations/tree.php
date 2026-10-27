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
            'message' => "Read the problem statement above.\nFrom [1, 2, 3, 4, 5, 6] to [2, 3, 4, 5, 6, 1], how do the half sums change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Resum both halves for every rotation', 'next' => 'wrong_a'],
                ['label' => 'Front loses 1 and gains 4; the back does the opposite', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Resumming costs O(n) per rotation, about 10^10 steps for n = 10^5.\nStep back to when you resummed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 2: every rotation is\nfront = 3\nback = 3\nGood or not?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Good, ties count', 'next' => 'wrong_b'],
                ['label' => 'Not good, it must be strictly greater', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Counting ties gives 4 instead of 0.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two running sums, O(1) per rotation. O(n). Examples give 3 and 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
