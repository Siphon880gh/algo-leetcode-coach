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
            'message' => "Problem: n = 2^x teams (x ≤ 12). Each round pairs strongest with weakest; output the bracket. n = 4 → \"((1,4),(2,3))\". (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pair first with last, round after round', 'next' => 's2'],
                ['label' => 'Pair a[2i] with a[2i + 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pairing neighbors gives ((1,2),(3,4)); strong must meet weak.\nStep back to when you paired neighbors.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After round 1 for n = 8: [(1,8), (2,7), (3,6), (4,5)].\nWho meets in round 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(1,8) with (2,7)', 'next' => 'wrong_b'],
                ['label' => '(1,8) with (4,5), and (2,7) with (3,6)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Position 0 meets the last position, which is (4,5), not (2,7).\nStep back to when you paired the next one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Repeat halving until one string is left. O(n log n) characters.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fold first-with-last each round, no spaces', 'next' => 'success'],
                ['label' => 'Join pairs with ", "', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Spaces are not in the format: \"(1,4)\", not \"(1, 4)\".\nStep back to when you added spaces.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Fold the list in half each round. n = 8 → \"(((1,8),(4,5)),((2,7),(3,6)))\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
