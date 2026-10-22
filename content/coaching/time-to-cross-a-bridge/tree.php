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
            'message' => "Read the problem statement above.\nWorkers waiting on both sides?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The right side crosses first', 'next' => 's2'],
                ['label' => 'The left side crosses first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Workers holding boxes have priority; n = 3, k = 2, time = [[2,4,1,3],[1,3,2,1]] → 13 instead of 14.\nStep back to when you sent the left side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The answer is when the last box?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Is put down', 'next' => 'wrong_b'],
                ['label' => 'Reaches the left bank', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Putting the last box down is not counted; Example 1 → 7 instead of 6.\nStep back to when you added put time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + k) log k). Examples → 6, 37.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
