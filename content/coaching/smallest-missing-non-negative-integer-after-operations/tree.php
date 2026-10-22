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
            'message' => "Read the problem statement above.\nRemainder of a negative number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '((x mod v) + v) mod v', 'next' => 's2'],
                ['label' => 'x % v as most languages compute it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. −1 % 2 gives −1, a bucket never used; nums = [−1,0], value = 2 → 1 instead of 2.\nStep back to when you kept the negative remainder.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After using a number for m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave the count', 'next' => 'wrong_b'],
                ['label' => 'Decrease its remainder count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each number covers one value; Example 1 never stops instead of 4.\nStep back to when you kept the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + value). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
