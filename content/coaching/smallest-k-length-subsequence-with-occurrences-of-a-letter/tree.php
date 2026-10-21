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
            'message' => "Read the problem statement above.\nPop a larger top when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only if enough characters remain to still reach length k', 'next' => 's2'],
                ['label' => 'Always', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Popping too much leaves fewer than k characters to build from.\nStep back to when you always popped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The top is the letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop it like any other character', 'next' => 'wrong_b'],
                ['label' => 'Pop only if enough letters remain to meet repetition', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You could fall below repetition copies; bb, k = 2, b × 2 needs both.\nStep back to when you ignored the letter count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Push a non-letter when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only if free slots remain beyond the letters still needed', 'next' => 'success'],
                ['label' => 'Whenever the stack is shorter than k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Non-letters could fill the slots that the required letters need.\nStep back to when you pushed freely.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → eet, ecde, bb.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
