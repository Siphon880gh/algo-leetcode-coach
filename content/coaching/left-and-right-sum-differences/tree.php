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
            'message' => "Read the problem statement above.\nright at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'total − left − nums[i]', 'next' => 's2'],
                ['label' => 'total − left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. nums[i] is on neither side; Example 1 → [25,5,3,19] instead of [15,1,11,22].\nStep back to when you kept nums[i].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does nums[i] join left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before the output', 'next' => 'wrong_b'],
                ['label' => 'After the output', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Left excludes i; Example 1 → [5,7,27,28] instead of [15,1,11,22].\nStep back to when you added it early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [15,1,11,22], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
