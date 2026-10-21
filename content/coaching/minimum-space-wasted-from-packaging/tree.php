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
            'message' => "Read the problem statement above.\nSupplier's largest box < largest package?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the supplier', 'next' => 's2'],
                ['label' => 'Use it anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The largest package would not fit.\nStep back to when you used it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Per supplier cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Loop over all packages', 'next' => 'wrong_b'],
                ['label' => 'O(boxes · log n) via bisect', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With 10^5 suppliers that is too slow.\nStep back to when you looped packages.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When to apply the mod?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After choosing the minimum', 'next' => 'success'],
                ['label' => 'On each supplier total', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Modded totals cannot be compared.\nStep back to when you modded early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 6, -1, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
