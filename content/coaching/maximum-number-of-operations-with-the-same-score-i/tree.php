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
            'message' => "Read the problem statement above.\nScore?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[0] + nums[1]', 'next' => 's2'],
                ['label' => 'The most common pair sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Operations always take the first two; [1, 1, 3, 3, 3, 3] → 2 instead of 1.\nStep back to when you picked the common sum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At a pair with another sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it and keep counting', 'next' => 'wrong_b'],
                ['label' => 'Stop', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 1, 3, 3, 1, 1] → 2 instead of 1.\nStep back to when you skipped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
