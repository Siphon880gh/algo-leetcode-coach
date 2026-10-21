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
            'message' => "Read the problem statement above.\nTry every subset of people?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: DP over skill masks', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. People can number 60.\nStep back to when you tried subsets of people.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A person extends mask m. New mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm + personMask', 'next' => 'wrong_b'],
                ['label' => 'm | personMask', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Shared skills would be counted twice.\nStep back to when you added masks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you overwrite dp[new mask]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the new team is smaller', 'next' => 'success'],
                ['label' => 'Always', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You would lose a smaller team.\nStep back to when you always overwrote.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(people · 2^skills). [\"java\",\"nodejs\",\"reactjs\"] with [[\"java\"],[\"nodejs\"],[\"nodejs\",\"reactjs\"]] → [0,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
