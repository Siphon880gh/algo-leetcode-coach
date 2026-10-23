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
            'message' => "State:\ns = \"abcdefg\"\nn = 2\n\nAfter left rotate, result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"cdefgab"', 'next' => 'method'],
                ['label' => '"fgabcde" — that is a right rotate shape', 'next' => 'w_right'],
            ],
        ],
        'w_right' => [
            'message' => "Wrong.\n\nLeft rotate by 2 moves the prefix `ab` to the end → `cdefgab`.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'method' => [
            'message' => "State:\nin-place preference\nA = first n chars, B = rest\n\nThree-reversal idea?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse all, reverse new prefix |B|, reverse suffix |A|', 'next' => 'cost'],
                ['label' => 'Delete s[0] and append it, n times', 'next' => 'w_slow'],
            ],
        ],
        'w_slow' => [
            'message' => "Wrong.\n\nThat is the O(n²) trap when each delete shifts. Prefer slice or three reversals.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'method',
            'choices' => [],
        ],
        'cost' => [
            'message' => "State:\nthree reversals on length n\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n²)', 'next' => 'w_q'],
            ],
        ],
        'w_q' => [
            'message' => "Wrong.\n\nEach reversal is linear; three of them are still O(n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'cost',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Left rotate = `s[n:] + s[:n]`\n- Or three reversals in O(n)\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
