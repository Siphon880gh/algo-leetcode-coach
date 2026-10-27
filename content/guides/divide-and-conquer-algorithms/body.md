## Tiny example

Merge sort on `[3, 1, 4, 2]`:

1. **Divide** it into `[3, 1]` and `[4, 2]`.
2. **Conquer** by sorting each half, giving `[1, 3]` and `[2, 4]`.
3. **Combine** by merging the halves into `[1, 2, 3, 4]`.

The two halves are independent of each other. The combine step does the real work of joining them.

## How

1. Split the problem into smaller pieces of the same kind.
2. Solve each piece recursively. Tiny inputs are the base case.
3. Merge the answers with a clear combine step.

## Trap

Calling every recursive algorithm divide and conquer, even when the pieces overlap heavily. Heavy overlap points toward dynamic programming instead.

**Fix:** If the same subproblem comes up again and again, add memoization or use DP. Pure divide and conquer expects independent pieces.

**Time:** often T(n) = 2T(n/2) + O(n), which is O(n log n) · **Space:** depends on the combine step

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
