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
            'message' => "Read the problem statement above.\nRecord a score when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only once the window holds a b', 'next' => 's2'],
                ['label' => 'For any window', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A window of only a scores 1; Example 2 → 1 instead of 0.\nStep back to when you scored windows with no b.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reset when the sum goes negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always', 'next' => 'wrong_b'],
                ['label' => 'Only if another b remains', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. baa → 0 instead of 1: the reset throws away the only b.\nStep back to when you always reset.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both (a, b) and (b, a)', 'next' => 'success'],
                ['label' => 'Only a before b in the alphabet', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 needs b as the major letter; → 2 instead of 3.\nStep back to when you tried one order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26² · n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
