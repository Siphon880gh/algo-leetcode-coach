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
            'message' => "Problem: Hens and grains sit at integer positions on a line. Every second each hen may move one unit left or right, all hens moving at once, and a hen eats every grain it reaches; one hen can eat many grains. Find the minimum time until every grain is eaten. The exact limits are in the official statement. For instance, hens [3] and grains [1,5] → 6, and hens [3,6] with grains [1,7] → 2. (Restated from memory; limits and examples may differ slightly.)\nA hen goes left d first. Rightward reach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p + max(t − 2d, (t − d) / 2)', 'next' => 's2'],
                ['label' => 'p + t − d', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It has to walk back past its start; hens [3], grains [1,5] → 4 instead of 6.\nStep back to when you used t − d.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of hens in the sweep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As given', 'next' => 'wrong_b'],
                ['label' => 'Sorted by position', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The leftmost grain must go to the leftmost hen; hens [6,3], grains [1,7] → 5 instead of 2.\nStep back to when you kept the input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((h + g) log range). Constructed checks → 6, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
