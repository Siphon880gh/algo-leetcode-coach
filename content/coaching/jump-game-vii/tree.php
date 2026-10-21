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
            'message' => "Read the problem statement above.\nMark targets from each reachable index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, that is O(n · range)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ranges up to 10^5 make it quadratic.\nStep back to when you marked every target.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Index entering the window at j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j − maxJump', 'next' => 'wrong_b'],
                ['label' => 'j − minJump', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. j − maxJump is the far end, already inside.\nStep back to when you added the far end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Index leaving the window at j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j − maxJump − 1', 'next' => 'success'],
                ['label' => 'j − minJump − 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That index is still within range.\nStep back to when you removed it early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
