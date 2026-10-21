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
            'message' => "Problem: Given a positive integer num, return the smallest positive integer whose digits multiply to num, or 0 if there is none or it does not fit in 32 bits. 48 → 68. 15 → 35. (Restated from memory; limits and examples may differ slightly.)\nWhich digits do you divide out first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From 9 down to 2', 'next' => 's2'],
                ['label' => 'From 2 up to 9', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 2 · 2 · 2 uses three digits where 8 uses one, and fewer digits means a smaller number.\nStep back to when you started from 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After 9 down to 2, num is still not 1. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append the leftover as one more digit', 'next' => 'wrong_b'],
                ['label' => 'Return 0: a prime factor above 7 remains', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The leftover is at least 11 and not a single digit, so no digit product works.\nStep back to when you appended it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "In what order do you write the digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing, then check against 2^31 − 1', 'next' => 'success'],
                ['label' => 'In the order you found them, largest first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. For 48 that gives 86, but 68 is smaller.\nStep back to when you kept the largest first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Greedy 9 → 2, fail on a leftover prime, digits ascending with an overflow check (num < 10 returns num): O(log num).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
