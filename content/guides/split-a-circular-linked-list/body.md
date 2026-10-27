You get the head of a circular singly linked list, where the last node points back to the first. Split it into two circular lists: the first half and the second half of the nodes in order, and return both heads. How an odd length is divided, and the limits, are in the official statement; the examples here give the middle node to the first half. For instance, 4 → 8 → 15 → 16 → 23 → [4 → 8 → 15, 16 → 23], and 1 → 2 → [1, 2], each part closing back on itself. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Cut and close

1. Count the nodes n by walking until you return to head (or use slow and fast pointers).
2. `a` = node number `h` of the first half, where h is the first half’s size; `head2 = a.next`.
3. Walk from head2 to the old last node (whose next is head); set `last.next = head2` and `a.next = head`.
4. Return `[head, head2]`.

Constructed checks (simulated in code): the two lists above split as shown.

Stop every walk on reaching head again, not on null; a circular list has no null.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
