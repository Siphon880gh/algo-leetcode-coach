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
            'message' => "Read the problem statement above.\ndeQueue: shift the remaining elements left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: move a head index with % k', 'next' => 's2'],
                ['label' => 'Yes: list.pop(0)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Shifting is O(n) per deQueue; moving the head is O(1).\nStep back to when you shifted elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you tell full from empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare head == tail only', 'next' => 'wrong_b'],
                ['label' => 'Keep a size counter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. head == tail happens both when the queue is empty and when it is full.\nStep back to when you compared the pointers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where is the rear?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[(head + size − 1) % k]', 'next' => 'success'],
                ['label' => 'a[size − 1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Once the queue wraps, the last item is not at the start of the array.\nStep back to when you ignored the head.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. An array with head and size, everything mod k: O(1) per operation, O(k) space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
