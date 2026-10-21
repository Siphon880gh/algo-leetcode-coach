## Each element as the minimum

1. Prefix sums `P`.
2. Monotonic stack: `L[i]` = previous index with smaller value, `R[i]` = next index with value ≤ (or <) `nums[i]`.
3. `best = max(nums[i] · (P[R[i]] − P[L[i] + 1]))`; return `best mod 1e9+7`.

`[1,2,3,2]` → 14. `[2,3,3,1,2]` → 18. `[3,1,5,6,4,2]` → 60.

Maximise before taking the modulo; the statement guarantees the true value fits in 64 bits. All values are positive, so the widest span for a given minimum is best.

Time: O(n)  
Space: O(n)

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
