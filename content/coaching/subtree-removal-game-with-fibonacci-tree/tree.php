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
            'message' => "Problem: A Fibonacci tree is built as order(0) = empty, order(1) = a single node, and order(n) = a root whose left subtree is order(n − 2) and right subtree is order(n − 1). Alice and Bob alternate turns, Alice first; a turn removes one node together with its whole subtree. The player forced to remove the root loses. Given n, return true if Alice wins with optimal play. For instance n = 1 → false, n = 2 → true, n = 3 → true. (Restated from memory; limits and examples may differ slightly.)\nDecide by the parity of the node count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, use Grundy values', 'next' => 's2'],
                ['label' => 'Yes, odd count means Alice wins', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n = 3 has 4 nodes and Alice still wins.\nStep back to when you used parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine children's values how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum of (child + 1)', 'next' => 'wrong_b'],
                ['label' => 'XOR of (child + 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. At n = 7 both children have value 3: the XOR is 0 (Alice loses), but the sum is 8.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Resulting pattern?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Alice loses exactly when n % 6 == 1', 'next' => 'success'],
                ['label' => 'Alice loses exactly when n is odd', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. n = 3 and n = 5 are odd and Alice wins both.\nStep back to when you used odd n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Constructed checks → false, true, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
