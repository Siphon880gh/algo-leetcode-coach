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
            'message' => "Read the problem statement above.\nProcess the cars in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By position, nearest the target first', 'next' => 's2'],
                ['label' => 'By speed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Cars cannot pass, so only the car ahead can block you.\nStep back to when you sorted by speed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Speed alone', 'next' => 'wrong_b'],
                ['label' => 'Arrival time (target − position) / speed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A fast car far behind may never catch up.\nStep back to when you compared speeds.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A car arrives no later than the fleet ahead. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It joins that fleet', 'next' => 'success'],
                ['label' => 'It forms a new fleet', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It catches up by the target at the latest, then moves at the slower speed.\nStep back to when you started a new fleet.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). target = 12, position = [10,8,0,5,3], speed = [2,4,1,1,3] → 3. target = 10, position = [3], speed = [3] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
