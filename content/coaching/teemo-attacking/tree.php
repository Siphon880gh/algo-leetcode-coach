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
                ['label' => 'Count each attack until the next one starts', 'next' => 's2'],
                ['label' => 'Mark every poisoned second in a set', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Times reach 1e7 and durations 1e7; marking seconds can mean 1e11 steps.\nStep back to when you marked each second.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Attack i at t, next attack at t'.\nHow much does attack i add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'duration for every attack', 'next' => 'wrong_b'],
                ['label' => 'min(duration, t\' − t)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Overlap is not added twice. [1,2], 2 would give 4 instead of 3.\nStep back to when you added the full duration every time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The last attack adds a full duration. One pass, O(n). This is interval union (56) specialized to equal lengths.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum min(duration, gap), plus duration at the end. Not 56', 'next' => 'success'],
                ['label' => 'Only sum the gaps, nothing for the last attack', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last attack has no next one, so it lasts the full duration. Without it, [1,4], 2 gives 2 instead of 4.\nStep back to when you skipped the last attack.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Each attack counts until the next, the last one fully. [1,4], 2 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
