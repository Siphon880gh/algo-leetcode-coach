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
            'message' => "Read the problem statement above.\nFinish time of a 1 with zeros before it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(previous finish + 1, zeros)', 'next' => 's2'],
                ['label' => 'zeros', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A 1 can be blocked by the 1 ahead; Example 1 → 3 instead of 4.\nStep back to when you used zeros alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A 1 with no zeros before it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Apply the same update', 'next' => 'wrong_b'],
                ['label' => 'Skip it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It never moves; Example 2 → 3 instead of 0.\nStep back to when you updated it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The answer counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Seconds, all swaps in a second happen together', 'next' => 'success'],
                ['label' => 'Swaps', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 7 instead of 4.\nStep back to when you counted swaps.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
