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
            'message' => "Problem: Binary tree with up to 3e4 nodes. A consecutive path changes by exactly 1 per step, all increasing or all decreasing, and it may bend through a parent (child → parent → child). Return the longest such path, counted in nodes. [2,1,3] → 3 (1 → 2 → 3). (Restated from memory; limits and examples may differ slightly.)\nWhat does each node report to its parent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two lengths: longest increasing and longest decreasing run going down', 'next' => 's2'],
                ['label' => 'One length: the longest increasing run going down', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A path through a node can go down a decreasing run on one side and an increasing run on the other; one number cannot carry both.\nStep back to when you kept one run.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A child has value node + 1. Which run does it extend?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The decreasing run', 'next' => 'wrong_b'],
                ['label' => 'inc = max(inc, child.inc + 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Going down from node to child the value rises by 1, so it extends the increasing run.\nStep back to when you picked the run.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine at the node. What is the best path through it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ans = max(ans, inc + dec − 1)', 'next' => 'success'],
                ['label' => 'ans = max(ans, inc + dec)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The node sits in both runs, so inc + dec counts it twice.\nStep back to when you added the runs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Post-order (inc, dec) per node, best path inc + dec − 1: O(n) time, O(h) space. [2,1,3] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
