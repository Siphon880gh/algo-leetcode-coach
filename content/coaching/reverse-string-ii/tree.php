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
                ['label' => 'Step through blocks of 2k', 'next' => 's2'],
                ['label' => 'Reverse the whole string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Reversing the whole string is 344. Only parts are reversed here.\nStep back to when you reversed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Block starting at i.\nWhich part do you reverse?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole 2k block', 'next' => 'wrong_b'],
                ['label' => 'i to min(i + k, n) − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The second half of each 2k block stays as is.\nStep back to when you reversed 2k characters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "min(i + k, n) handles both short-tail rules. O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Step 2k, reverse the first k (clamped)', 'next' => 'success'],
                ['label' => 'Step by k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Stepping by k would reverse every chunk, including those meant to stay.\nStep back to when you stepped by k.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Step 2k, reverse the clamped first k. → \"bacdfeg\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
