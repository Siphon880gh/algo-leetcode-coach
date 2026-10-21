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
            'message' => "Read the problem statement above.\nHow do you swap neighbors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Change the ids: odd → id + 1, even → id − 1', 'next' => 's2'],
                ['label' => 'Add 1 to every id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Even ids would also move up, so they would collide with the next pair instead of swapping.\nStep back to when you shifted every id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The count is odd. What about the last seat?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move it to id + 1', 'next' => 'wrong_b'],
                ['label' => 'Leave it: there is no partner', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. There is no seat id + 1, so the last student stays put.\nStep back to when you moved the last seat.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You have the new ids. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ORDER BY the new id', 'next' => 'success'],
                ['label' => 'Keep the table order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output must list the seats in id order, which is what shows the swap.\nStep back to when you skipped the sort.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. CASE on odd/even with the last-odd exception, ORDER BY id: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
