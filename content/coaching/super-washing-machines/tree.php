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
                ['label' => 'Find lower bounds that the parallel moves must respect', 'next' => 's2'],
                ['label' => 'Sum the dresses that have to move', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Moves run in parallel; summing transfers overcounts. [1,0,5] needs 3 moves, but 4 dresses move.\nStep back to when you summed the transfers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "a_i = machines[i] − avg, s = running prefix of a.\nWhat does |s| bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only |s|; the per-machine excess does not matter', 'next' => 'wrong_b'],
                ['label' => 'Both |s| and a_i: a machine sends at most one dress per move', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. |s| dresses must cross the boundary after i, one per move. That alone misses a machine that must give dresses to both sides.\nStep back to when you used only the prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "[0,3,0]: a = [−1,2,−1], |s| ≤ 1, but the middle machine needs 2 moves. Answer = max over i of max(|s_i|, a_i). O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1 if uneven, else max of |prefix| and positive excess', 'next' => 'success'],
                ['label' => 'Use |a_i| for the per-machine bound', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A machine short by 2 can receive from both sides in one move. |a_i| overstates it.\nStep back to when you used |a_i|.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two lower bounds, both tight. [1,0,5] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
