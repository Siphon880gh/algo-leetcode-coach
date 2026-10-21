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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep a running count that resets at each 0', 'next' => 's2'],
                ['label' => 'Count all the 1s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Total 1s is not the longest run. [1,0,1] has two 1s and a longest run of 1.\nStep back to when you counted all 1s.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "cnt += 1 on a 1, cnt = 0 on a 0.\nWhen do you update best?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when you hit a 0', 'next' => 'wrong_b'],
                ['label' => 'On every 1: best = max(best, cnt)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last run may end at the array end with no 0 after it. [1,1,0,1,1,1] would report 2.\nStep back to when you updated best only at zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One pass, O(n) time, O(1) space. Max Consecutive Ones II (487) allows one flip; III (1004) allows k.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset at 0, update on 1. Not 487 / 1004', 'next' => 'success'],
                ['label' => 'Join two runs across a single 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No flips are allowed here. Bridging a 0 is the 487 rule.\nStep back to when you joined runs across a 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count, reset at zeros, update the best on every 1. [1,1,0,1,1,1] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
