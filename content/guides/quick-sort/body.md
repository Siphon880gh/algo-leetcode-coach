## Tiny example

Sort `[3, 1, 4, 2]`, using the last element, `2`, as the pivot.

Partition the array so that smaller values end up to the left of the pivot:

1. Scan the array, swapping values `< 2` toward the left.
2. Put the pivot in place, giving `[1, 2, 4, 3]`. The exact layout depends on the partition scheme, but the pivot's index is final.
3. Recurse on the part left of the pivot and the part right of it.

With good pivots, the recursion is about log n deep. If the pivot is always the worst choice, it is n deep.

## How (Lomuto partition)

1. Choose a pivot, often `a[hi]`.
2. Grow a region of items that are ≤ the pivot.
3. Swap the pivot into its final index `p`.
4. Quick-sort `lo … p-1` and `p+1 … hi`.

## Trap

Always using the last element as the pivot on an already sorted array. That takes **O(n²)** time.

**Fix:** Shuffle first, or use the median of three, or a random pivot. The average is then **O(n log n)**, with an expected **O(log n)** of extra stack.

**Time:** average O(n log n), worst O(n²)  
**Space:** expected O(log n) of stack

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
