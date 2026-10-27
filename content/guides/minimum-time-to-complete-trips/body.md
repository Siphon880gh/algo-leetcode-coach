## Monotone trip count

1. `lo = 1`, `hi = min(time) · totalTrips`.
2. `ok(T) = Σ T / time[i] ≥ totalTrips`.
3. Binary search the smallest `T` with `ok(T)`.

Examples → 3, 2.

The fastest bus alone reaches the target by `hi`, so the answer is within range. `hi` reaches 10^14, so use 64-bit and stop summing once the total is reached.

Time: O(n log(min(time) · totalTrips))  
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
