Given the head of a singly linked list sorted in non-decreasing order of absolute values, return the list sorted in non-decreasing order of actual values. For instance, [0,2,-5,5,10,-10] → [-10,-5,0,2,5,10]; [0,1,2] → [0,1,2]; [1] → [1]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Head insertion

1. `prev = head`, `cur = head.next`.
2. While `cur`: if `cur.val < 0`, unlink it (`prev.next = cur.next`), set `cur.next = head`, `head = cur`, `cur = prev.next`; else `prev = cur`, `cur = cur.next`.
3. Return `head`.

Constructed checks (verified against sorting on random lists sorted by absolute value): the three cases above.

Each later negative has a larger absolute value, so it is smaller than everything moved before it and belongs at the front. One pass, no extra list.

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
