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
            'message' => "Problem: binary nums, length up to 1e5. Flip at most one 0. Return the longest run of 1s. [1,0,1,1,0] → 4. [1,0,1,1,0,1] → 4. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Slide a window that contains at most one 0', 'next' => 's2'],
                ['label' => 'Try flipping each 0 and rescan the whole array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Flipping each 0 and rescanning is O(n²) and cannot handle the stream follow-up.\nStep back to when you tried every flip.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "r moves right. A second 0 enters the window.\nWhat do you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Restart the window at r', 'next' => 'wrong_b'],
                ['label' => 'Move l to one past the earlier zero', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Restarting at r throws away the 1s after the first zero, which can still pair with the new zero.\nStep back to when you reset the window.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Track the last zero index; on a new zero, l = last + 1, last = r. Best = max(r − l + 1). O(n) time, O(1) space — works for a stream too.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Window width with at most one zero. Not 485 / 1004', 'next' => 'success'],
                ['label' => 'Longest 1s run plus 1 for the flip', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With no zeros at all, the whole array is one run. Adding 1 for a flip you did not use overcounts.\nStep back to when you added a bonus 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One-zero window, jump l past the old zero. [1,0,1,1,0] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
