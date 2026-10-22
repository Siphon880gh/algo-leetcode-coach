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
            'message' => "Read the problem statement above.\nPopularity is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total views', 'next' => 's2'],
                ['label' => 'Views of the best single video', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. alice’s two 5s total 10; Example 1 → [[bob, two]] instead of both.\nStep back to when you used the best video.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A creator’s videos tie on views?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the first one seen', 'next' => 'wrong_b'],
                ['label' => 'Keep the smaller id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. creators = [x, x], ids = [c, b], views = [2, 2] → c instead of b.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width for totals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Totals reach 10^5 · 10^5 = 10^10.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · L). Examples → [[alice, one], [bob, two]], [[alice, b]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
