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
            'message' => "Read the problem statement above.\nExample 1: robots at 5 and 6 merge at t = 0. How does the group move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Like the rightmost robot: from 6 at speed 2', 'next' => 's2'],
                ['label' => 'At the average speed of the two', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A merged group takes the position and speed of its rightmost robot. With speed 2 from 6, robot 1 joins at t = 2 and the answer is 2.\nStep back to when you averaged the group.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "position = [1, 3, 4]\nspeed = [4, 2, 4]\ndistance = 1\nDoes robot 1 ever join?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, it is faster than robot 2', 'next' => 'wrong_b'],
                ['label' => 'No, robots 2 and 3 merge at once and run at speed 4', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Robot 2 merges into robot 3 at t = 0, so robot 1 chases speed 4, not speed 2. Neighbour-only checking gives 1 group instead of 2.\nStep back to when you compared with robot 2 only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. A right-to-left stack of leaders with exact join times. O(n). Examples give 2, 2 and 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
