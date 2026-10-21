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
            'message' => "Read the problem statement above.\nSimulate moves on the grid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare Manhattan distances to the target', 'next' => 's2'],
                ['label' => 'Yes, with BFS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any ghost that can reach the target first can wait there.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A ghost is exactly as far as you. Result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'You win', 'next' => 'wrong_b'],
                ['label' => 'You lose: you arrive together', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reaching the target at the same time counts as caught.\nStep back to when you allowed ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Could a ghost catch you before the target even if it is farther from it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: then it could have reached the target first', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Intercepting you on a shortest path implies reaching the target no later than you.\nStep back to when you worried about interception.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(g). ghosts [[1,0],[0,3]], target [0,1] → true. [[1,0]], [2,0] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
