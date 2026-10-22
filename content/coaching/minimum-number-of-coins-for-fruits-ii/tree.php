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
            'message' => "Problem: This is the same task as Minimum Number of Coins for Fruits (buying fruit i lets you take the next i fruits free, and you may still buy a free fruit), with larger limits given in the official statement. Return the minimum coins to get every fruit. For instance, under those rules, [3, 1, 2] → 4 and [1, 10, 1, 1] → 2. (Restated from memory; limits and examples may differ slightly.)\nNext fruit to buy after buying i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any j in i + 1 … 2i + 1', 'next' => 's2'],
                ['label' => 'Any j in i + 1 … 2i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Fruit 2i + 1 is the first one not free, and you may wait for it; [1, 10, 1, 1] → 12 instead of 2.\nStep back to when you stopped at 2i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window minimum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the cheapest price in the window', 'next' => 'wrong_b'],
                ['label' => 'Monotonic deque as i decreases', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You need the cheapest f, the cost of finishing from there, not the cheapest single price.\nStep back to when you compared prices.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
