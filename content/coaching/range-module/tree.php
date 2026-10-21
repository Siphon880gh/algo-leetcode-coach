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
            'message' => "Read the problem statement above.\nTrack each covered number in a set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: store sorted disjoint intervals', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ranges reach 10⁹ numbers.\nStep back to when you stored numbers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "addRange [10, 20) when [20, 30) is tracked. Merge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: they do not overlap', 'next' => 'wrong_b'],
                ['label' => 'Yes: they touch, giving [10, 30)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Keeping touching intervals separate breaks queries that cross 20.\nStep back to when you kept them apart.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "removeRange cuts the middle of [10, 30). Result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to two pieces: the left and right remainders', 'next' => 'success'],
                ['label' => 'Delete the whole interval', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The parts outside the removed range stay tracked.\nStep back to when you deleted it all.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n + k) per operation. add [10,20), remove [14,16): query [10,14) → true, [13,15) → false, [16,17) → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
