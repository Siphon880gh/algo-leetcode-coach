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
            'message' => "State:\ns = \"abcdefg\"\nn = 2\n\nWhat is the result of the left rotation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"cdefgab"', 'next' => 'method'],
                ['label' => '"fgabcde", which is what a right rotation gives', 'next' => 'w_right'],
            ],
        ],
        'w_right' => [
            'message' => "Wrong.\n\nA left rotation by 2 moves the prefix `ab` to the end, giving `cdefgab`.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'method' => [
            'message' => "State:\nyou prefer to work in place\nA is the first n characters, and B is the rest\n\nWhat is the three-reversal idea?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse everything, then the first |B| characters, then the last |A|', 'next' => 'cost'],
                ['label' => 'Delete s[0] and append it, n times', 'next' => 'w_slow'],
            ],
        ],
        'w_slow' => [
            'message' => "Wrong.\n\nThat is the O(n²) trap when each delete shifts the string. Use a slice or three reversals.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'method',
            'choices' => [],
        ],
        'cost' => [
            'message' => "State:\nthree reversals on a string of length n\n\nWhat is the time cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n²)', 'next' => 'w_q'],
            ],
        ],
        'w_q' => [
            'message' => "Wrong.\n\nEach reversal is linear, so three of them are still O(n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'cost',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- A left rotation is `s[n:] + s[:n]`.\n- Three reversals also do it in O(n).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
