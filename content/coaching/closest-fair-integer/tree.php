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
            'message' => "Problem: An integer is fair when it has as many even digits as odd digits. Given a positive integer n, return the smallest fair integer that is at least n. For instance, 2 → 10, 403 → 1001 and 1234 → 1234. (Restated from memory; limits and examples may differ slightly.)\nn has an odd number of digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Go to the next even length', 'next' => 's2'],
                ['label' => 'Search the same length', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An odd count of digits cannot split evenly; 403 has no 3-digit answer, and the answer is 1001.\nStep back to when you searched the same length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fill after the raised digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Needed odd digits as 1s, then even digits as 0s', 'next' => 'wrong_b'],
                ['label' => 'Needed even digits as 0s, then needed odd digits as 1s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1189 → 1210 instead of 1201.\nStep back to when you put the 1s first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Smallest fair number with 2m digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, then m zeros, then m − 1 ones', 'next' => 'success'],
                ['label' => '10 repeated m times', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 99 → 1010 instead of 1001.\nStep back to when you repeated 10.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L² · 10). Constructed checks → 10, 1001, 1234.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
