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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Monotonic stack, walking the array twice', 'next' => 's2'],
                ['label' => 'From each element, scan forward up to n steps', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Scanning up to n steps from each element is O(n²): 1e8. Slow.\nStep back to when you scanned from every element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Values repeat, so the stack holds indexes.\nWhat range does i cover?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i from 0 to n − 1 only', 'next' => 'wrong_b'],
                ['label' => 'i from 0 to 2n − 1, using nums[i % n]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One pass misses wraparound; the last 1 in [1,2,1] needs to see the 2 at the start.\nStep back to when you walked once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "While nums[top] < nums[i % n]: ans[top] = nums[i % n]. Push only when i < n. Initialize ans to −1. O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Double pass, strict <, indexes on the stack. Not 496 / 739', 'next' => 'success'],
                ['label' => 'Pop while nums[top] <= current', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal values are not greater. Popping on <= gives 1 as the answer for another 1.\nStep back to when you popped on equal.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two passes with i mod n and a strict test. [1,2,1] → [2,−1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
