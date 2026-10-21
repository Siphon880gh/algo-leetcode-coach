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
                ['label' => 'Count how many outcomes p pigs can produce', 'next' => 's2'],
                ['label' => 'One pig per bucket per round', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Testing one bucket per pig per round wastes information: a pig can drink from many buckets at once.\nStep back to when you gave each pig one bucket.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "t = minutesToTest // minutesToDie rounds.\nHow many outcomes does one pig have?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2: dies or survives', 'next' => 'wrong_b'],
                ['label' => 't + 1: dies after round 1, 2, …, t, or survives', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A pig that survives all rounds is also an outcome. With t rounds that is t + 1 states, not t, and not 2 unless t = 1.\nStep back to when you counted the states.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "p pigs give (t + 1)^p outcomes, and labeling buckets in base t + 1 reaches it. Return the smallest p with (t + 1)^p >= buckets, by multiplying in a loop. buckets = 1 → 0.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest p with (t + 1)^p >= buckets, integer loop', 'next' => 'success'],
                ['label' => 'ceil(log(buckets) / log(t + 1)) in floating point', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. log(buckets) / log(t + 1) in floating point can land just above an integer and round the wrong way.\nStep back to when you used float logs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Each pig is a base-(t + 1) digit. Smallest p with (t + 1)^p >= buckets. 1000, 15, 60 → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
