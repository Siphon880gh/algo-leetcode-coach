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
            'message' => "Problem: Problem: n bulbs in a row start off. On day i + 1 bulb bulbs[i] turns on (bulbs is a permutation of 1 … n). Given k, return the earliest day on which two lit bulbs have exactly k bulbs between them, all still off, or -1 if that never happens. (Restated from memory; limits and examples may differ slightly.)\nSimulate day by day and scan for gaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: invert to days[pos], the day each position lights', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Scanning each day is O(n²).\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When is the window left, right = left + k + 1 valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two ends light on consecutive days', 'next' => 'wrong_b'],
                ['label' => 'Every inside position lights later than both ends', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The k bulbs between must still be off when the second end lights.\nStep back to when you compared the ends only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "An inside position lights earlier than an end. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Restart the window with that position as the new left end', 'next' => 'success'],
                ['label' => 'Shift the window right by one', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every window containing that position fails too, so jump to it.\nStep back to when you shifted by one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One sliding pass, recording max(days[left], days[right]) per valid window: O(n). bulbs = [1,3,2], k = 1 → 2. bulbs = [1,2,3], k = 1 → -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
