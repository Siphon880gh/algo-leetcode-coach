## Tiny example

Build a max-heap from `[2, 3, 9, 5, 6]` **from the bottom up**.

With n = 5, the last parent is at index `(n-2)//2 = 1`, which holds the value `3`.

Sift down each parent, from the last parent back to the root:

1. At index 1 (value `3`), the children are `5` and `6`. Swap `3` with the larger child, `6`.
2. At index 0 (value `2`), sift down until the heap order holds. `2` swaps with `9`.

The result is `[9, 6, 2, 5, 3]`, with `9` at the root. The total work is **O(n)**, not O(n log n).

## Compare: n separate pushes

Starting empty and pushing n items one at a time costs **O(n log n)**. Building from the bottom up is faster because most nodes sit near the bottom, where sifting down is short.

## Trap

Implementing "build" as n inserts and still claiming O(n).

**Fix:** Use Floyd's heapify, which sifts down from the last parent to the root. The sum of all the node heights is O(n), so the build is O(n).

**Time (heapify):** O(n)  
**Time (n pushes):** O(n log n)  
**Space:** O(1) extra, done inside the array

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
