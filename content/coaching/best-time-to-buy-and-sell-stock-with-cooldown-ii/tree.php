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
            'message' => "Problem: You get prices[0 … n − 1], a cooldown, and costs[0 … n − 1], where costs[d] is a one-time fee for a trade that holds the share for exactly d days. You hold at most one share. After selling on day j, the earliest next buy is day j + cooldown + 1. Buying on day i and selling on day j earns prices[j] − prices[i] − costs[j − i]. Return the best total profit, or 0 if nothing helps. Example: prices = [1, 5, 3], cooldown = 1, costs = [2, 0, 1] gives 4. n ≤ 1500.\nCan one \"holding\" state pay the fee costs[j − i] as you go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, pay it on the buy day', 'next' => 'wrong_a'],
                ['label' => 'No, the fee depends on the buy day, so loop over buy days', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. On the buy day you do not know how long you will hold, so you cannot know which costs entry applies.\nStep back to when you paid the fee early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "prices = [5, 9, 2, 5]\ncooldown = 1, costs all 0\nSell on day 1 and buy again on day 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, the earliest buy is day 3', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After a sale on day 1 the earliest buy is day 1 + 1 + 1 = 3. Ignoring the cooldown gives 7 instead of 4.\nStep back to when you bought on day 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. F[j] over every buy day i, chained through F[i − cooldown − 1]. O(n²). Examples give 4, 3, 6 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
