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
            'message' => "Problem: Problem: Given terrain heights, a number of water units, and a drop index k, drop the units one at a time at k. Each unit moves left if that lets it eventually fall lower, else right if that does, else stays; it settles at the lowest reachable spot in that direction, nearest k on ties. Return the final heights. (Restated from memory; limits and examples may differ slightly.)\nWhich direction do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left', 'next' => 's2'],
                ['label' => 'Whichever side is lower', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The rule always prefers left when left lets the water fall.\nStep back to when you compared sides.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Scanning left, when do you stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the first lower cell', 'next' => 'wrong_b'],
                ['label' => 'When the next cell is higher than the current one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Water keeps rolling over flat or downhill ground to the lowest point it can reach.\nStep back to when you stopped at the first lower cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two cells share the lowest height. Which gets the water?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one nearer k, by updating only on strictly lower', 'next' => 'success'],
                ['label' => 'The farther one', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ties go to the position closest to the drop.\nStep back to when you took the farther one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(volume · n). heights = [2,1,1,2,1,2,2], volume = 4, k = 3 → [2,2,2,3,2,2,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
