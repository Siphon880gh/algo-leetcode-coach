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
            'message' => "Read the problem statement above.\nExample 3: do [1, 2] and [3, 4] cover the target [1, 4]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, every integer 1 to 4 is covered', 'next' => 'wrong_a'],
                ['label' => 'No, 2.5 is not covered', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every real point counts, and 2.5 lies in neither interval. Checking integers gives 2 instead of −1.\nStep back to when you checked integers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "available = [[1, 2], [3, 4]]\ntargets = [[1, 2], [3, 4]]\nMust the gap between 2 and 3 be covered?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, only points inside targets matter', 'next' => 'success'],
                ['label' => 'Yes, coverage must be continuous from the first target', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Points outside the targets need no coverage. Here two intervals are enough, while requiring the gap gives −1.\nStep back to when you covered the gap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Farthest-reach greedy over sorted targets. Examples give 3, −1 and −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
