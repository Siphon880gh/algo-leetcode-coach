## Tiny example

Sort `[3, 1, 4, 2]` with pivot = last element `2`.

Partition so smaller keys go left of pivot:

1. Scan; swap values `< 2` toward the left
2. Place pivot → `[1, 2, 4, 3]` (exact layout depends on partition scheme; pivot index is final)
3. Recurse on left of pivot and right of pivot

With good pivots, depth is ~log n; with always-worst pivots, depth is n.

## How (Lomuto sketch)

1. Choose pivot (often `a[hi]`)
2. Grow a boundary of items ≤ pivot
3. Swap pivot into its final index `p`
4. Quick-sort `lo … p-1` and `p+1 … hi`

## Trap

Always pivoting on a sorted array’s last element → **O(n²)** time.

**Fix:** Shuffle first, or use median-of-three / random pivot. Average **O(n log n)**; extra stack **O(log n)** expected.

**Time:** average O(n log n), worst O(n²)  
**Space:** O(log n) stack expected

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
