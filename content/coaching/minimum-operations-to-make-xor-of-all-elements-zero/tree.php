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
            'message' => "Problem: You get an array nums of positive integers, each at most 2000, with length up to 10^5. One move picks two indices whose values differ and replaces one of them with their XOR. Return the fewest moves that make the XOR of the whole array 0, or −1 if it can never happen. Example: [8, 1, 4, 8, 2] needs 3 moves, [1, 2, 3] needs 0, and [1, 2, 4] is impossible.\nReplace nums[i] with nums[i] ^ nums[j]. What happens to the total X?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It becomes X ^ nums[j]', 'next' => 's2'],
                ['label' => 'It stays the same', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In [8, 1, 4, 8, 2], replacing 8 by 8 ^ 1 = 9 changes the total from 7 to 7 ^ 1 = 6.\nStep back to when you assumed the total is fixed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 1:\nX = 7\n7 is not in the array.\nIs it impossible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, return −1', 'next' => 'wrong_b'],
                ['label' => 'No, find the fewest values whose XOR is 7', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1 ^ 4 ^ 2 = 7, so 3 moves work. Giving up after one move gives −1 instead of 3.\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. BFS over 2048 XOR values, and −1 only when every element is needed. Examples give 3, 0 and −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
